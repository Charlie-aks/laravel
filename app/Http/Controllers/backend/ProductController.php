<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productsale;
use App\Models\Productimage;
use App\Models\Productstore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $list = Product::select(
            'product.id',
            'product.name',
            'category.name as categoryname',
            'brand.name as brandname',
            'product.status',
            'product.price_root',
            'productsale.price_sale',
            'productstore.qty'
        )
        ->join('category', 'product.category_id', '=', 'category.id')
        ->join('brand', 'product.brand_id', '=', 'brand.id')
        ->leftJoin('productsale', 'product.id', '=', 'productsale.product_id')
        ->leftJoin('productstore', 'product.id', '=', 'productstore.product_id')
        ->with('productimage')
        ->orderBy('product.created_at', 'desc')
        ->paginate(5);

        return view('backend.product.index', ['list' => $list]);
    }

    public function create()
    {
        $list_category = Category::select('name', 'id')->orderBy('sort_order', 'asc')->get();
        $list_brand = Brand::select('name', 'id')->orderBy('sort_order', 'asc')->get();
        return view('backend.product.create', compact('list_category', 'list_brand'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->description = $request->description;
        $product->price_root = $request->price_root;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->status = $request->status;
        $product->slug = Str::slug($request->name);
        $product->created_by = Auth::id();
        $product->save();

        // Create initial store record
        Productstore::create([
            'product_id' => $product->id,
            'qty' => 0,
            'price_root' => $request->price_root,
            'created_by' => Auth::id(),
            'status' => 1
        ]);

        // Handle image uploads
        if ($request->hasFile('thumbnail')) {
            foreach ($request->file('thumbnail') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('assets/images/product'), $imageName);
                
                Productimage::create([
                    'product_id' => $product->id,
                    'thumbnail' => $imageName
                ]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công');
    }

    public function edit(string $id)
    {
        $product = Product::with(['thumbnail', 'sale', 'store'])->find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Sản phẩm không tồn tại.');
        }
        $list_category = Category::select('name', 'id')->orderBy('sort_order', 'asc')->get();
        $list_brand = Brand::select('name', 'id')->orderBy('sort_order', 'asc')->get();
        
        return view('backend.product.edit', compact('list_category', 'list_brand', 'product'));
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->description = $request->description;
        $product->price_root = $request->price_root;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->slug = Str::slug($request->name);
        $product->updated_by = Auth::id() ?? 1;
        $product->updated_at = now();
        $product->save();

        if($request->hasFile('thumbnail')) {
            foreach($request->file('thumbnail') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/images/product'), $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'thumbnail' => $filename,
                ]);
            }
        }

        $productStore = ProductStore::where('product_id', $id)->first();
        if ($productStore) {
            $productStore->qty = $request->qty;
            $productStore->price_root = $product->price_root;
            $productStore->updated_at = now();
            $productStore->save();
        }

        if ($request->has('price_sale')) {
            $productSale = ProductSale::where('product_id', $id)->first();
            if ($productSale) {
                $productSale->price_sale = $request->price_sale;
                $productSale->updated_at = now();
                $productSale->save();
            } else {
                ProductSale::create([
                    'product_id' => $id,
                    'price_sale' => $request->price_sale,
                    'date_begin' => now(),
                    'date_end' => now()->addDays(30),
                    'created_by' => Auth::id() ?? 1,
                ]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy(string $id)
    {
        $product = Product::onlyTrashed()->find($id);
        if (!$product) return redirect()->route('product.trash');

        // Xoá ảnh vật lý
        $image = ProductImage::where('product_id', $product->id)->first();
        if ($image && File::exists(public_path('assets/images/product/' . $image->thumbnail))) {
            File::delete(public_path('assets/images/product/' . $image->thumbnail));
        }

        // Xoá các bản ghi liên quan
        ProductImage::where('product_id', $product->id)->forceDelete();
        ProductStore::where('product_id', $product->id)->forceDelete();
        ProductSale::where('product_id', $product->id)->forceDelete();

        // Xoá sản phẩm
        $product->forceDelete();

        return redirect()->route('product.trash')->with('success', 'Sản phẩm đã bị xóa vĩnh viễn!');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) return redirect()->route('product.index');

        // Xóa ảnh vật lý
        $image = ProductImage::where('product_id', $id)->first();
        if ($image && File::exists(public_path('assets/images/product/' . $image->thumbnail))) {
            File::delete(public_path('assets/images/product/' . $image->thumbnail));
        }

        // Xoá các bản ghi liên quan
        ProductImage::where('product_id', $id)->delete();
        ProductStore::where('product_id', $id)->delete();
        ProductSale::where('product_id', $id)->delete();

        $product->delete(); // Soft delete

        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được đưa vào thùng rác!');
    }

    public function trash()
    {
        $list = Product::onlyTrashed()
            ->select(
                'product.id',
                'product.name',
                'category.name as categoryname',
                'brand.name as brandname',
                'product.status',
                'productimage.thumbnail',
                'product.price_root',
                'productsale.price_sale',
                'productstore.qty'
            )
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->leftJoin('productimage', 'product.id', '=', 'productimage.product_id')
            ->leftJoin('productsale', 'product.id', '=', 'productsale.product_id')
            ->leftJoin('productstore', 'product.id', '=', 'productstore.product_id')
            ->orderBy('product.created_at', 'desc')
            ->paginate(5);

        return view('backend.product.trash', ['list' => $list]);
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->find($id);
        if ($product) {
            $product->restore();
        }
        return redirect()->route('product.trash');
    }

    public function show($id)
    {
        $product = Product::select(
            'product.*',
            'category.name as categoryname',
            'brand.name as brandname',
            'productstore.qty'
        )
        ->join('category', 'product.category_id', '=', 'category.id')
        ->join('brand', 'product.brand_id', '=', 'brand.id')
        ->leftJoin('productstore', 'product.id', '=', 'productstore.product_id')
        ->with('productimage')
        ->findOrFail($id);

        return view('backend.product.show', compact('product'));
    }

    public function status($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->status = $product->status == 1 ? 0 : 1;
            $product->updated_by = Auth::id() ?? 1;
            $product->updated_at = now();
            $product->save();
        }
        return redirect()->route('product.index');
    }

    public function productImage()
    {
        return $this->hasOne(ProductImage::class);
    }

    public function productSale()
    {
        return $this->hasOne(ProductSale::class);
    }

    public function productStore()
    {
        return $this->hasOne(ProductStore::class);
    }

    public function deleteImage($id)
    {
        $image = ProductImage::find($id);
        if ($image) {
            // Xóa file ảnh
            $imagePath = public_path('assets/images/product/' . $image->thumbnail);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            // Xóa record trong database
            $image->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function storeManagement($id)
    {
        $product = Product::with('store')->findOrFail($id);
        $storeHistory = Productstore::where('product_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('backend.product.store', compact('product', 'storeHistory'));
    }

    public function updateStore(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:0',
            'price_root' => 'required|numeric|min:0',
        ]);

        $store = Productstore::where('product_id', $id)->first();
        
        if (!$store) {
            $store = new Productstore();
            $store->product_id = $id;
            $store->created_by = Auth::id();
            $store->status = 1;
        }

        $store->qty = $request->qty;
        $store->price_root = $request->price_root;
        $store->updated_by = Auth::id();
        $store->save();

        return redirect()->route('product.store', ['product' => $id])
            ->with('success', 'Cập nhật thông tin kho thành công');
    }
}
