<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspek extends Model
{
    use HasFactory;
    protected $table = 'aspek';
    protected $fillable = [
        'nama_aspek',
        'kode',
        'kelas_id',
    ];

    public function kelas()
{
    return $this->belongsTo(Kelas::class, 'kelas_id');
}

public function aspek()
{
    return $this->belongsTo(Aspek::class, 'aspek_id');
}

}