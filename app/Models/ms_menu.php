<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_menu extends Model
{
    use HasFactory;

    protected $table = 'ms_menu';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_menu',
        'nama_menu_en',
        'parameter',
        'icon_class',
        'parent',
        'urut',
        'aktif',
        'tipe',
        'lvl',
        'shortcut',
        'tampil',
        'subpage',
    ];

    public function contents()
    {
        return $this->hasMany(ms_content::class, 'id_menu', 'id');
    }


    public function parentMenu()
    {
        return $this->belongsTo(ms_menu::class, 'parent', 'id');
    }

    // Relasi ke children
    public function childMenus()
    {
        return $this->hasMany(ms_menu::class, 'parent', 'id');
    }
    
}
