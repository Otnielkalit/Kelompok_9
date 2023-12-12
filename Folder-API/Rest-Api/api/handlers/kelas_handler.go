package handlers

import (
	"Rest-Api/db"
	"Rest-Api/models"
	"fmt"

	"github.com/gin-gonic/gin"
)

func GetKelasList(c *gin.Context) {
	var kelas []models.Kelas
	db.DB.Find(&kelas)

	c.JSON(200, kelas)
}

func GetKelasByID(c *gin.Context) {
	id := c.Params.ByName("id")
	var kelas models.Kelas
	if err := db.DB.Where("id = ?", id).First(&kelas).Error; err != nil {
		c.AbortWithStatus(404)
	} else {
		c.JSON(200, kelas)
	}
}

// CreateKelas handles the POST /kelas endpoint
func CreateKelas(c *gin.Context) {
	var kelas models.Kelas
	c.BindJSON(&kelas)

	db.DB.Create(&kelas)
	c.JSON(200, kelas)
}

// UpdateKelas handles the PUT /kelas/:id endpoint
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

// DeleteKelas handles the DELETE /kelas/:id endpoint
func DeleteKelas(c *gin.Context) {
	id := c.Params.ByName("id")
	var kelas models.Kelas
	d := db.DB.Where("id = ?", id).Delete(&kelas)
	fmt.Println(d)
	c.JSON(200, gin.H{"id #" + id: "deleted"})
}
