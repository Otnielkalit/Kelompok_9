// api/routes/routes.go

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

    r.POST("/login", handlers.Login)

    aspek := r.Group("/aspek")
    {
        aspek.GET("/", handlers.GetAspekList)
        aspek.GET("/:id", handlers.GetAspekByID)
        aspek.POST("/", handlers.CreateAspek)
        aspek.PUT("/:id", handlers.UpdateAspek)
        aspek.DELETE("/:id", handlers.DeleteAspek)
    }

	return r
}
