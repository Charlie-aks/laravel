<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $args = [['status', '=', 1]];

        // Category
        if ($request->category_slug) {
            $slug = $request->category_slug;
            $category = Category::where([['status', '=', 1], ['slug', '=', $slug]])->first();
            if ($category != null) {
                $listcategoryid = $this->getListCategory($category->id);
            }
        }

        // Brand
        if ($request->brand_slug) {
            $slug = $request->brand_slug;
            $brand = Brand::where([['status', '=', 1], ['slug', '=', $slug]])->first();
            if ($brand != null) {
                array_push($args, ['brand_id', '=', $brand->id]);
            }
        }

        $query = Product::with(['productimage', 'sale'])
            ->where($args)
            ->orderBy('created_at', 'desc');
        
        if (isset($listcategoryid)) {
            $query->whereIn('category_id', $listcategoryid);
        }

        $product_list = $query->get();
        return view('frontend.product', compact('product_list'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        
        if (!$keyword) {
            return redirect()->route('site.product');
        }

        $product_list = Product::with(['productimage', 'sale'])
            ->where('status', 1)
            ->where(function($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                    ->orWhere('detail', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.product', compact('product_list', 'keyword'));
    }
    
    public function detail($slug)
    {
        $product_item = Product::with(['productimage', 'sale'])
            ->where([['status', '=', 1], ['slug', '=', $slug]])
            ->first();

        // Kiểm tra nếu không tìm thấy sản phẩm
        if (!$product_item) {
            return redirect()->route('site.home')->with('error', 'Sản phẩm không tồn tại.');
        }

        $listcategoryid = $this->getListCategory($product_item->category_id);

        $product_list = Product::with(['productimage', 'sale'])
            ->where([
                ['status', '=', 1],
                ['id', '<>', $product_item->id]
            ])
            ->whereIn('category_id', $listcategoryid)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('frontend.product-detail', compact('product_item', 'product_list'));
    }

    private function getListCategory($category_id)
    {
        $list = [$category_id];
        
        // Lấy danh mục con cấp 1
        $category_list1 = Category::where([
            ['status', '=', 1],
            ['parent_id', '=', $category_id]
        ])->pluck('id')->toArray();
        
        if (!empty($category_list1)) {
            $list = array_merge($list, $category_list1);
            
            // Lấy danh mục con cấp 2
            $category_list2 = Category::where([
                ['status', '=', 1],
                ['parent_id', 'in', $category_list1]
            ])->pluck('id')->toArray();
            
            if (!empty($category_list2)) {
                $list = array_merge($list, $category_list2);
                
                // Lấy danh mục con cấp 3
                $category_list3 = Category::where([
                    ['status', '=', 1],
                    ['parent_id', 'in', $category_list2]
                ])->pluck('id')->toArray();
                
                if (!empty($category_list3)) {
                    $list = array_merge($list, $category_list3);
                }
            }
        }
        
        return $list;
    }
}