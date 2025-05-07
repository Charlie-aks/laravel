<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = 'product';
    use SoftDeletes;
    protected $fillable = [
        'name', 'detail', 'description', 'price_root',
        'category_id', 'brand_id', 'status','slug','created_by'
    ];

    public function productimage()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function thumbnail()
    {
        return $this->hasOne(ProductImage::class, 'product_id');
    }

    public function image()
    {
        return $this->hasOne(ProductImage::class, 'product_id');
    }

    public function store()
    {
        return $this->hasOne(ProductStore::class, 'product_id');
    }

    public function sale()
    {
        return $this->hasOne(ProductSale::class, 'product_id');
    }
}
