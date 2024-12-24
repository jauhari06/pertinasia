<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_userrole extends Model
{
    use HasFactory;

    protected $table = 'ms_userrole';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_tipeuser',
        'id_menu',
        'tambah',
        'edit',
        'hapus',
        'status',  
    ];

    public function tipeuser()
    {
        return $this->belongsTo(ms_tipeuser::class, 'id_tipeuser', 'id');
    }

    public function menu()
    {
        return $this->belongsTo(ms_menu::class, 'id_menu', 'id');
    }
}
