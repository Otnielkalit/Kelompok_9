<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'poto',
        'agama',
        'kelas_id',
        'alamat',
    ];

    public function kelas()
{
    return $this->belongsTo(Kelas::class, 'kelas_id');
}

}