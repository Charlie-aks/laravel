<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $table = 'post';
    use SoftDeletes;
    protected $fillable = ['name',
    'topic_id',
    'title',
    'slug',
    'detail',
    'thumbnail',
    'type',
    'description',
    'created_by',
    'status',
    'updated_by'];
}
