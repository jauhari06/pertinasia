<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_welcomescreen extends Model
{
    use HasFactory;

    protected $table = 'ms_welcomescreen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'welcome_text',
        'welcome_text_en',
        'gambar_id',
        'id_menu',
        'aktif',
    ];
}
