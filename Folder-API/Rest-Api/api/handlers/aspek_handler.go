// api/handlers/aspek_handler.go

package handlers

import (
	"fmt"
	"net/http"
	"time"
	"Rest-Api/db"
	"Rest-Api/models"

	"github.com/gin-gonic/gin"
)

func CreateAspek(c *gin.Context) {
    var newAspek models.Aspek
    if err := c.ShouldBindJSON(&newAspek); err != nil {
        // Log kesalahan dalam binding data
        fmt.Println("Error binding JSON:", err.Error())

        c.JSON(http.StatusBadRequest, gin.H{"error": "Invalid input: " + err.Error()})
        return
    }

    // Periksa apakah nama_aspek tidak kosong
    if newAspek.NamaAspek == "" {
        c.JSON(http.StatusBadRequest, gin.H{"error": "Nama aspek tidak boleh kosong"})
        return
    }

    // Pastikan proses binding dan validasi telah berjalan dengan baik
    // Setelah itu, lanjutkan dengan proses simpan ke database
    currentTime := time.Now()
    newAspek.CreatedAt = currentTime
    newAspek.UpdatedAt = currentTime

    db.DB.Create(&newAspek)
    c.JSON(http.StatusOK, newAspek)
}



func GetAspekList(c *gin.Context) {
    var aspekList []models.Aspek
    db.DB.Find(&aspekList)
    c.JSON(http.StatusOK, aspekList)
}

func GetAspekByID(c *gin.Context) {
    id := c.Params.ByName("id")
    var aspek models.Aspek
    if err := db.DB.Where("id = ?", id).First(&aspek).Error; err != nil {
        c.AbortWithStatus(http.StatusNotFound)
        return
    }
    c.JSON(http.StatusOK, aspek)
}

func UpdateAspek(c *gin.Context) {
    id := c.Params.ByName("id")
    var aspek models.Aspek
    if err := db.DB.Where("id = ?", id).First(&aspek).Error; err != nil {
        c.AbortWithStatus(http.StatusNotFound)
        return
    }

    var updatedAspek models.Aspek
    if err := c.BindJSON(&updatedAspek); err != nil {
        c.JSON(http.StatusBadRequest, gin.H{"error": "Invalid input"})
        return
    }

    currentTime := time.Now()
    updatedAspek.UpdatedAt = currentTime

    db.DB.Model(&aspek).Updates(updatedAspek)
    c.JSON(http.StatusOK, updatedAspek)
}

func DeleteAspek(c *gin.Context) {
    id := c.Params.ByName("id")
    var aspek models.Aspek
    if err := db.DB.Where("id = ?", id).First(&aspek).Error; err != nil {
        c.AbortWithStatus(http.StatusNotFound)
        return
    }

    db.DB.Delete(&aspek)
    c.JSON(http.StatusOK, gin.H{"message": "Aspek deleted"})
}
