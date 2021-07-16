<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Users extends Model
{
    
    protected $table = 'users';
    protected $guarded = [];
    protected $hidden = [
        'password'
    ];

}
