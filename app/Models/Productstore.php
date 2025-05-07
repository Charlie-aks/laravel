<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productstore extends Model
{
    protected $table = 'productstore';
    use SoftDeletes;
    protected $fillable = [
        'product_id', 'qty', 'price_root', 'created_at', 'updated_at' 
    ];

}
