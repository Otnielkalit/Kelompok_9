package handlers

import (
	"Rest-Api/db"
	"Rest-Api/models"
	"fmt"
	"github.com/gin-gonic/gin"
	"net/http"
	"time"
)

type Response struct {
	Status  int         `json:"status"`
	Message string      `json:"message"`
	Data    interface{} `json:"data,omitempty"`
}

func GetKelasList(c *gin.Context) {
	var kelas []models.Kelas
	db.DB.Find(&kelas)

	response := Response{
		Status:  http.StatusOK,
		Message: "Daftar kelas berhasil diambil",
		Data:    kelas,
	}

	c.JSON(http.StatusOK, response)
}

func GetKelasByID(c *gin.Context) {
	id := c.Params.ByName("id")
	var kelas models.Kelas
	if err := db.DB.Where("id = ?", id).First(&kelas).Error; err != nil {
		response := Response{
			Status:  http.StatusNotFound,
			Message: "Kelas tidak ditemukan",
		}
		c.JSON(http.StatusNotFound, response)
	} else {
		response := Response{
			Status:  http.StatusOK,
			Message: "Detail kelas berhasil diambil",
			Data:    kelas,
		}
		c.JSON(http.StatusOK, response)
	}
}

func CreateKelas(c *gin.Context) {
	var newKelas models.Kelas
	if err := c.ShouldBindJSON(&newKelas); err != nil {
		response := Response{
			Status:  http.StatusBadRequest,
			Message: "Invalid input: " + err.Error(),
		}
		c.JSON(http.StatusBadRequest, response)
		return
	}

	if newKelas.NamaKelas == "" {
		response := Response{
			Status:  http.StatusBadRequest,
			Message: "Nama kelas harus diisi",
		}
		c.JSON(http.StatusBadRequest, response)
		return
	}

	if newKelas.Kode == "" {
		response := Response{
			Status:  http.StatusBadRequest,
			Message: "Kode kelas harus diisi",
		}
		c.JSON(http.StatusBadRequest, response)
		return
	}

	// Check if the NamaKelas or Kode already exists
	var existingKelas models.Kelas
	if err := db.DB.Where("nama_kelas = ? OR kode = ?", newKelas.NamaKelas, newKelas.Kode).First(&existingKelas).Error; err == nil {
		// Data already exists
		response := Response{
			Status:  http.StatusConflict,
			Message: "Data sudah ada dalam basis data",
			Data:    existingKelas,
		}
		c.JSON(http.StatusConflict, response)
		return
	}

	currentTime := time.Now()
	newKelas.CreatedAt = currentTime
	newKelas.UpdatedAt = currentTime

	db.DB.Create(&newKelas)

	response := Response{
		Status:  http.StatusOK,
		Message: "Kelas berhasil dibuat",
		Data:    newKelas,
	}
	c.JSON(http.StatusOK, response)
}

func UpdateKelas(c *gin.Context) {
	id := c.Params.ByName("id")
	var kelas models.Kelas
	if err := db.DB.Where("id = ?", id).First(&kelas).Error; err != nil {
		c.AbortWithStatus(404)
		return
	}

	c.BindJSON(&kelas)
	db.DB.Save(&kelas)
	c.JSON(200, kelas)
}
func DeleteKelas(c *gin.Context) {
	id := c.Params.ByName("id")
	var kelas models.Kelas
	d := db.DB.Where("id = ?", id).Delete(&kelas)
	fmt.Println(d)
	c.JSON(200, gin.H{"id #" + id: "deleted"})
}
