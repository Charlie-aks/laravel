<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    protected $table = 'contact';
    use SoftDeletes;
    protected $fillable = ['name','phone','id','status','created_by','email','title','content'];

}
