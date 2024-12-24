<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class data_pendidikan extends Model
{
    use HasFactory;

    protected $table = 'data_pendidikan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_mahasiswa',
        'pendidikan_terakhir',
        'nama_institusi',
        'program_studi',
        'tahun_lulus'
    ];

    public function pendidikan()
    {
        return $this->hasMany(data_pendidikan::class, 'id_mahasiswa', 'id');
    }
}
