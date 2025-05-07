<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    function index(){

        return view('frontend.cart');
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        
        // Lấy thông tin sản phẩm
        $product = Product::with(['productimage', 'sale'])
            ->where('id', $product_id)
            ->first();
            
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }

        // Lấy giỏ hàng hiện tại từ session
        $cart = session()->get('cart', []);
        
        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $cart[$product_id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->sale ? $product->sale->price_sale : $product->price_root,
                'image' => $product->productimage->first() ? $product->productimage->first()->thumbnail : 'default-thumbnail.jpg'
            ];
        }
        
        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    public function removeFromCart(Request $request)
    {
        $product_id = $request->input('product_id');
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }

    public function updateCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Giỏ hàng đã được xóa');
    }
}
