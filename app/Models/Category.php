<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = 'category';
    use SoftDeletes;
    protected $fillable = ['name','description','image','id','status','slug','sort_order','created_by','parent_id'];
}
