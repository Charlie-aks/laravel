<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    protected $table = 'menu';
    use SoftDeletes;
    protected $fillable = ['name',
        'link',
        'type',
        'position',
        'status',
        'sort_order',
        'parent_id',
        'created_by',
        'updated_by'];
}
