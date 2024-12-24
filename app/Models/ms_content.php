<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_content extends Model
{
    use HasFactory;

    protected $table = 'ms_content';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'deskripsi',
        'deskripsi_en',
        'id_menu',
        'aktif',
    ];

    public function menu()
    {
        return $this->belongsTo(ms_menu::class, 'id_menu', 'id');
    }
}
