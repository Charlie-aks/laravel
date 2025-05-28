<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    protected $table = 'orderdetail';
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = [
        'order_id',
        'product_id',
        'price_buy',
        'qty',
        'amount',
        'size'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
