<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

// ProductNew.php
class ProductNew extends Component
{
    public $latestProducts;

    public function __construct()
    {   

       $this->latestProducts = Product::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->take(4)
            ->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.product-new', ['products' => $this->latestProducts]);
    }
}
