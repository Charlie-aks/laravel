<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    protected $table = 'banner';
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'image',
        'position',
        'sort_order',
        'status',
        'created_by',
    ];
}
