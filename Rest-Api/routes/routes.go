package routes

import (
	"github.com/gin-gonic/gin"
	"Rest-Api/api/handlers"
)

func SetupRouter() *gin.Engine {
	r := gin.Default()

	kelas := r.Group("/kelas")
	{
		kelas.GET("/", handlers.GetKelasList)
		kelas.GET("/:id", handlers.GetKelasByID)
		kelas.POST("/", handlers.CreateKelas)
		kelas.PUT("/:id", handlers.UpdateKelas)
		kelas.DELETE("/:id", handlers.DeleteKelas)
	}

	return r
}