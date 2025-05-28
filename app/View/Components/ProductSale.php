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
        $this->saleProducts = Product::with(['productimage', 'sale'])
            ->where('status', 1)
            ->whereHas('sale', function($query) {
                $query->whereColumn('price_sale', '<', 'product.price_root');
            })
            ->orderBy('created_at', 'DESC')
            ->take(4)
            ->get();
    }

    public function render()
    {
        return view('components.product-sale', ['products' => $this->saleProducts]);
    }
}