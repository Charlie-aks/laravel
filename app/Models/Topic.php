<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    protected $table = 'topic';
    use SoftDeletes;
    protected $fillable = ['name',
    'name',
    'slug',
    'description',
    'created_by',
    'status',
    'updated_by'];
}
