<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_tipeuser extends Model
{
    use HasFactory;

    protected $table = 'ms_tipeuser';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'tipe_user',
    ]; 
    
    public function userRoles()
    {
        return $this->hasMany(ms_userrole::class, 'id_tipeuser', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tipeuser) {
            $tipeuser->userRoles()->delete();
        });
    }
}
