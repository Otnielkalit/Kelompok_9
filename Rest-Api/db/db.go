package db

import (
	"Rest-Api/models"
	"fmt"

	"github.com/jinzhu/gorm"
	_ "github.com/jinzhu/gorm/dialects/mysql"
)

var (
	DB *gorm.DB
)

func InitDB() {
	var err error
	DB, err = gorm.Open("mysql", "root:@tcp(localhost:3306)/tk_littlestar?parseTime=true")
	if err != nil {
		fmt.Println("Error connecting to database:", err)
		panic("Failed to connect to database")
	}

	DB.AutoMigrate(&models.Kelas{}, &models.KelasAspek{})
}
