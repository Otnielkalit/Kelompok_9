

package handlers

import (
	"net/http"

	"github.com/gin-gonic/gin"
	"Rest-Api/db"
	"Rest-Api/models"
	"golang.org/x/crypto/bcrypt"
)

func Login(c *gin.Context) {
	var input models.Akun
	if err := c.BindJSON(&input); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "Invalid input"})
		return
	}

	var akun models.Akun
	if err := db.DB.Table("akun").Where("username = ?", input.Username).First(&akun).Error; err != nil {
		c.JSON(http.StatusUnauthorized, gin.H{"error": "Invalid credentials"})
		return
	}

	err := bcrypt.CompareHashAndPassword([]byte(akun.Password), []byte(input.Password))
	if err != nil {
		c.JSON(http.StatusUnauthorized, gin.H{"error": "Invalid credentials"})
		return
	}
	c.JSON(http.StatusOK, gin.H{"message": "Login successful", "user": akun})
}
