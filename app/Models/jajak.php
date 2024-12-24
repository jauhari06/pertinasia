<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jajak extends Model
{
    use HasFactory;

    protected $table = 'jajak';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tgl',
        'jam',
        'pertanyaan',
        'jawab_a',
        'jawab_b',
        'jawab_c',
        'jawab_d',
        'jawab_e',
        'hasil_a',
        'hasil_b',
        'hasil_c',
        'hasil_d',
        'hasil_e',
        'aktif',
        'pertanyaan_en',
        'jawab_a_en',
        'jawab_b_en',
        'jawab_c_en',
        'jawab_d_en',
        'jawab_e_en',
    ];
}
