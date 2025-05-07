<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public $item;

    /**
     * Tạo mới một instance của component.
     */
    public function __construct($productrow)
    {
        $this->item = $productrow;
    }

    /**
     * Lấy view/contents đại diện cho component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card', ['product' => $this->item]);
    }
}
