<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productsale extends Model
{
    protected $table = 'productsale';
    use SoftDeletes;
    protected $fillable = [
        'product_id', 'price_sale', 'created_at', 'updated_at','date_begin', 'date_end', 'created_by',
    ];

    // Relationship với Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // Relationship với User (người tạo)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
