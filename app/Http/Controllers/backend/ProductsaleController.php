<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Productsale;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductsaleController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thực hiện chức năng này.');
        }

        $now = now();
        $productsales = Productsale::with('product')
            ->where('date_begin', '<=', $now)
            ->where('date_end', '>=', $now)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('backend.productsale.index', compact('productsales'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thực hiện chức năng này.');
        }

        $products = Product::where('status', 1)->get();
        return view('backend.productsale.create', compact('products'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thực hiện chức năng này.');
        }

        $request->validate([
            'product_id' => 'required|exists:product,id',
            'price_sale' => 'required|numeric|min:0',
            'date_begin' => 'required|date',
            'date_end' => 'required|date|after:date_begin',
        ]);

        $productsale = new Productsale();
        $productsale->product_id = $request->product_id;
        $productsale->price_sale = $request->price_sale;
        $productsale->date_begin = $request->date_begin;
        $productsale->date_end = $request->date_end;
        $productsale->created_by = Auth::id();
        $productsale->save();

        return redirect()->route('productsale.index')->with('success', 'Thêm giá sale thành công');
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thực hiện chức năng này.');
        }

        $productsale = Productsale::findOrFail($id);
        $products = Product::where('status', 1)->get();
        return view('backend.productsale.edit', compact('productsale', 'products'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thực hiện chức năng này.');
        }

        $request->validate([
            'product_id' => 'required|exists:product,id',
            'price_sale' => 'required|numeric|min:0',
            'date_begin' => 'required|date',
            'date_end' => 'required|date|after:date_begin',
        ]);

        $productsale = Productsale::findOrFail($id);
        $productsale->product_id = $request->product_id;
        $productsale->price_sale = $request->price_sale;
        $productsale->date_begin = $request->date_begin;
        $productsale->date_end = $request->date_end;
        $productsale->save();

        return redirect()->route('productsale.index')->with('success', 'Cập nhật giá sale thành công');
    }

    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thực hiện chức năng này.');
        }

        $productsale = Productsale::findOrFail($id);
        $productsale->delete();
        return redirect()->route('productsale.index')->with('success', 'Xóa giá sale thành công');
    }

    public function trash()
    {
        $productsales = Productsale::onlyTrashed()->with('product')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.productsale.trash', compact('productsales'));
    }

    public function delete($id)
    {
        return $this->destroy($id);
    }
} 