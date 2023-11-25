<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = [
        'user_id',
        'nisn',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'poto',
        'agama',
        'kelas_id',
        'alamat',
        'nama_ayah',
        'nama_ibu',
    ];
}