<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ProductSale extends Component
{
    public $saleProducts;

    public function __construct()
    {
        
        $this->saleProducts = DB::table('product')
        ->join('productsale', 'productsale.product_id', '=', 'product.id')
        ->where('product.status', 1)
        ->whereColumn('productsale.price_sale', '<', 'product.price_root')
        ->whereNull('product.deleted_at')
        ->orderBy('product.created_at', 'DESC')
        ->select('product.*', 'productsale.price_sale')
        ->take(4)
        ->get();
    }

    public function render()
    {
        return view('components.product-sale', ['products' => $this->saleProducts]);
    }
}