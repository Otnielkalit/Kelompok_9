// models/kegiatan.go

package models

import (
    "time"
)

type Kegiatan struct {
    ID          uint      `json:"id" gorm:"primary_key"`
    Title       string    `json:"title"`
    Start       time.Time `json:"start"`
    End         time.Time `json:"end"`
    Description string    `json:"description"`
    CreatedAt   time.Time `json:"created_at"`
    UpdatedAt   time.Time `json:"updated_at"`
}
