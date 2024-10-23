<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $table = 'admin';
    protected $primaryKey = 'id_admin' ;

    protected $fillable = [
        'username',
        'password',
        'nama_admin',
        'foto'
    ];

    protected $hidden = [
        'password'
    ];
}
