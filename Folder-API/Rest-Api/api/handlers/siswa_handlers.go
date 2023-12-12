package handlers

import (
	"Rest-Api/db"
	"Rest-Api/models"
	"errors"
	"net/http"
	"time"

	"github.com/gin-gonic/gin"
)

func GetSiswa(c *gin.Context) {
	id := c.Param("id")

	var siswa models.Siswa
	if err := db.DB.First(&siswa, id).Error; err != nil {
		c.JSON(http.StatusNotFound, gin.H{"error": "Siswa not found"})
		return
	}

	c.JSON(http.StatusOK, siswa)
}

func GetSiswas(c *gin.Context) {
	var siswas []models.Siswa
	if err := db.DB.Find(&siswas).Error; err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Failed to get siswas"})
		return
	}

	c.JSON(http.StatusOK, siswas)
}

func CreateSiswa(c *gin.Context) {
	var newSiswa models.Siswa

	if err := c.ShouldBindJSON(&newSiswa); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "Invalid siswa data: " + err.Error()})
		return
	}

	if err := validateSiswa(newSiswa); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	currentTime := time.Now()
	newSiswa.CreatedAt = currentTime
	newSiswa.UpdatedAt = currentTime

	db.DB.Create(&newSiswa)
	c.JSON(http.StatusCreated, newSiswa)
}

func UpdateSiswa(c *gin.Context) {
	id := c.Param("id")

	var updatedSiswa models.Siswa

	if err := db.DB.Where("id = ?", id).First(&updatedSiswa).Error; err != nil {
		c.JSON(http.StatusNotFound, gin.H{"error": "Siswa not found"})
		return
	}

	if err := c.ShouldBindJSON(&updatedSiswa); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "Invalid siswa data: " + err.Error()})
		return
	}

	updatedSiswa.UpdatedAt = time.Now()

	db.DB.Save(&updatedSiswa)
	c.JSON(http.StatusOK, updatedSiswa)
}

func DeleteSiswa(c *gin.Context) {
	id := c.Param("id")

	if err := db.DB.Delete(&models.Siswa{}, id).Error; err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Failed to delete siswa"})
		return
	}

	c.JSON(http.StatusOK, gin.H{"message": "Siswa deleted successfully"})
}

func validateSiswa(siswa models.Siswa) error {
	if siswa.NISN == "" {
		return errors.New("NISN harus diisi")
	}
	if siswa.Nama == "" {
		return errors.New("Nama harus diisi")
	}
	if siswa.TempatLahir == "" {
		return errors.New("Tempat lahir harus diisi")
	}
	if siswa.TanggalLahir.IsZero() {
		return errors.New("Tanggal lahir harus diisi")
	}
	if siswa.JenisKelamin == "" {
		return errors.New("Jenis kelamin harus diisi")
	}
	if siswa.Agama == "" {
		return errors.New("Agama harus diisi")
	}
	if siswa.KelasID == 0 {
		return errors.New("Kelas ID harus diisi")
	}
	if siswa.Alamat == "" {
		return errors.New("Alamat harus diisi")
	}
	if siswa.NamaAyah == "" {
		return errors.New("Nama ayah harus diisi")
	}
	if siswa.NamaIbu == "" {
		return errors.New("Nama ibu harus diisi")
	}

	return nil
}
