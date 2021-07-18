<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promo extends Model
{
    use SoftDeletes;
    
    protected $table = 'cms_tbl_promo';
    protected $guarded = [];

    const DELETED_AT = 'delete_time';
    

}
