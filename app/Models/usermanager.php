<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class usermanager extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usermanager';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'login',
        'pwd',
        'pwd_baru',
        'tipe',
        'last_login',
        'foto',
        'online',
        'id_prodi',
    ];

    public function getAuthPassword()
    {
        return $this->pwd_baru; // kolom yang berisi password yang di-hash
    }

    public function tipeUser()
    {
        return $this->belongsTo(ms_tipeuser::class, 'tipe', 'id');
    }
}
