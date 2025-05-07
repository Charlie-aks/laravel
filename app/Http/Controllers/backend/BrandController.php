<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $list = Brand::select('brand.id','brand.name','brand.image','brand.description','status')
       ->orderBy('created_at','desc')
       ->paginate(5);
       return view('backend.brand.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
    
        // Xử lý upload ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/images/brand'), $imageName);
            $imagePath = 'assets/images/brand/' . $imageName;
        }
    
        // Tạo slug từ tên
        $slug = Str::slug($request->name);
    
        // Sử dụng cách 1: new Brand -> gán từng field -> save()
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->image = $imagePath;
        $brand->status = $request->status;
        $brand->created_by = Auth::id() ?? 1;
        $brand->slug = $slug;
        $brand->sort_order = $request->sort_order ?? 0;
        $brand->created_at = now(); // thêm created_at nếu bạn không dùng timestamps tự động
        $brand->save();
    
        return redirect()->route('brand.index')->with('success', 'Thêm Brand thành công');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'Brand không tồn tại');
        }
        return view('backend.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'Không tìm thấy thương hiệu.');
        }

        // Validation (nếu cần)
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gán dữ liệu mới
        $brand->name = $request->name;
        $brand->slug = $request->slug ?: Str::slug($request->name);
        $brand->description = $request->description;
        $brand->status = $request->status;
        $brand->sort_order = $request->sort_order ?? 0;
        $brand->updated_by = Auth::id() ?? 1;
        $brand->updated_at = now();

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Xóa ảnh cũ nếu tồn tại
            if ($brand->image && File::exists(public_path($brand->image))) {
                File::delete(public_path($brand->image));
            }

            // Lưu ảnh mới
            $file->move(public_path('assets/images/brand'), $fileName);
            $brand->image = 'assets/images/brand/' . $fileName;
        }

        $brand->save();

        return redirect()->route('brand.index')->with('success', 'Cập nhật thương hiệu thành công!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::onlyTrashed()->find($id);
        if($brand==null)
        {
            return redirect()->route('brand.trash');
        }
        $image_path = public_path('assets/images/brand'.$brand->image);
        if($brand->forceDelete())
        {
            if(File::exists($image_path)){
                File::delete($image_path);
            }
        }
        return redirect()->route('brand.trash');
    }
    public function delete($id)
    {
        $brand = Brand::find($id);
        if($brand==null)
        {
            return redirect()->route('brand.index');
        }
        $brand->delete();
        return redirect()->route('brand.index');
    }
    public function trash()
    {
        $list = Brand::onlyTrashed()
            ->select('id', 'name','description','sort_order' ,'status', 'deleted_at','image')
            ->orderBy('deleted_at', 'desc')
            ->paginate(5);
    
        return view('backend.brand.trash', compact('list'));
    }
    public function restore($id)
    {
        $brand = Brand::onlyTrashed()->find($id);
        if ($brand) {
            $brand->restore();
        }
        return redirect()->route('brand.trash');
    }
    public function status($id){
        $brand = Brand::find($id);
        if($brand == null )
        {
            return redirect()->route('brand.index');
        }
        $brand->status = $brand->status == 1 ? 0 : 1;
        $brand->updated_by = Auth::id() ?? 1;
        $brand->updated_at = now();
        $brand->save();
        return redirect()->route('brand.index');
    }
}
