<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    protected $table = 'brand';
    use SoftDeletes;
    protected $fillable = ['name','description','image','id','status','slug','sort_order','created_by'   ];
}
