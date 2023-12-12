package models

import (
	"time"
)

type Siswa struct {
	ID           uint      `json:"id" gorm:"primary_key"`
	UserID       uint      `json:"user_id"`
	NISN         string    `json:"nisn"`
	Nama         string    `json:"nama"`
	TempatLahir  string    `json:"tempat_lahir"`
	TanggalLahir time.Time `json:"tanggal_lahir"`
	JenisKelamin string    `json:"jenis_kelamin"`
	Poto         string    `json:"poto"`
	Agama        string    `json:"agama"`
	KelasID      uint      `json:"kelas_id"`
	Alamat       string    `json:"alamat"`
	NamaAyah     string    `json:"nama_ayah"`
	NamaIbu      string    `json:"nama_ibu"`
	CreatedAt    time.Time `json:"created_at"`
	UpdatedAt    time.Time `json:"updated_at"`
}
