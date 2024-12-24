<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class calon_mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'calon_mahasiswa';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status',
        'kebangsaan',
        'alamat',
        'kode_pos',
        'telepon',
        'email'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(calon_mahasiswa::class, 'id_mahasiswa', 'id');
    }
}
