// api/handlers/kegiatan_handler.go

package handlers

import (
	"Rest-Api/db"
	"Rest-Api/models"
	"net/http"
	"time"

	"github.com/gin-gonic/gin"
)

func GetAllKegiatan(c *gin.Context) {
    var kegiatans []models.Kegiatan
    db.DB.Find(&kegiatans)

    c.JSON(http.StatusOK, kegiatans)
}

func CreateKegiatan(c *gin.Context) {
    var newKegiatan models.Kegiatan
    if err := c.ShouldBindJSON(&newKegiatan); err != nil {
        c.JSON(http.StatusBadRequest, gin.H{"error": "Invalid input: " + err.Error()})
        return
    }
    currentTime := time.Now()
    newKegiatan.CreatedAt = currentTime
    newKegiatan.UpdatedAt = currentTime

    db.DB.Create(&newKegiatan)
    c.JSON(http.StatusOK, newKegiatan)
}

func UpdateKegiatan(c *gin.Context) {
    kegiatanID := c.Param("id")
    var updatedKegiatan models.Kegiatan

    if err := db.DB.Where("id = ?", kegiatanID).First(&updatedKegiatan).Error; err != nil {
        c.JSON(http.StatusNotFound, gin.H{"error": "Kegiatan not found"})
        return
    }

    if err := c.ShouldBindJSON(&updatedKegiatan); err != nil {
        c.JSON(http.StatusBadRequest, gin.H{"error": "Invalid input: " + err.Error()})
        return
    }
    updatedKegiatan.UpdatedAt = time.Now()

    db.DB.Save(&updatedKegiatan)
    c.JSON(http.StatusOK, updatedKegiatan)
}
