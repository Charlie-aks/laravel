<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productimage extends Model
{
    protected $table = 'productimage';
    use SoftDeletes;
    protected $fillable = [
        'product_id', // Thêm product_id vào mảng fillable
        'thumbnail',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function thumbnail()
    {
        return $this->hasOne(ProductImage::class)->where('thumbnail', true);
    }
}
