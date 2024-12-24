<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'ms_pendaftaran';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_pts',
        'alamat_pts',
        'kota_pts',
        'pos_pts',
        'thn_berdiri',
        'jmlh_prodi',
        'email_pts',
        'tlp_pts',
        'fax_pts',
        'web_pts',
        'nama',
        'tmp_lahir',
        'tgl_lahir',
        'masa_jbtn',
        'alamat',
        'kota',
        'kode_pos',
        'tlpn',
        'handphone',
        'email',
        'tgl',
    ];
}
