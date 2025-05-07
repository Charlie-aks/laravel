<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $list = Category::select('id', 'name', 'slug', 'image', 'status', 'description', 'sort_order', 'parent_id', 'created_by')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.category.index', compact('list'));
    }

    public function create()
    {
        $category = Category::where('status', 1)->orderBy('name', 'asc')->get();
        return view('backend.category.create', compact('category'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/images/category'), $imageName);
            $imagePath = 'assets/images/category/' . $imageName;
        }

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $imagePath;
        $category->status = $request->status ?? 1;
        $category->slug = Str::slug($request->name);
        $category->sort_order = $request->sort_order ?? 0;
        $category->created_by = Auth::id() ?? 1;
        $category->parent_id = $request->parent_id ?? 0;
        $category->created_at = now();
        $category->save();

        return redirect()->route('category.index')->with('success', 'Thêm category thành công');
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        $categories = Category::where('status', 1)->where('id', '!=', $id)->get();
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Category không tồn tại');
        }
        return view('backend.category.edit', compact('category', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Không tìm thấy category.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug ?: Str::slug($request->name);
        $category->description = $request->description;
        $category->status = $request->status;
        $category->sort_order = $request->sort_order ?? 0;
        $category->updated_by = Auth::id() ?? 1;
        $category->parent_id = $request->parent_id ?? 0;
        $category->updated_at = now();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();

            if ($category->image && File::exists(public_path($category->image))) {
                File::delete(public_path($category->image));
            }

            $file->move(public_path('assets/images/category'), $fileName);
            $category->image = 'assets/images/category/' . $fileName;
        }

        $category->save();

        return redirect()->route('category.index')->with('success', 'Cập nhật category thành công!');
    }

    public function destroy(string $id)
    {
        $category = Category::onlyTrashed()->find($id);
        if (!$category) {
            return redirect()->route('category.trash');
        }

        $image_path = public_path($category->image);
        if ($category->forceDelete()) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        return redirect()->route('category.trash');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.index');
        }
        $category->delete();
        return redirect()->route('category.index');
    }

    public function trash()
    {
        $list = Category::onlyTrashed()
            ->select('id', 'name', 'description', 'sort_order', 'status', 'deleted_at', 'image', 'parent_id', 'created_by')
            ->orderBy('deleted_at', 'desc')
            ->paginate(5);

        return view('backend.category.trash', compact('list'));
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);
        
        if ($category) {
            $category->restore(); // Khôi phục
            return redirect()->route('category.index')->with('success', 'Thương hiệu đã được khôi phục.');
        }
    
        return redirect()->route('category.index')->with('error', 'Không tìm thấy thương hiệu.');
    }
    public function status($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.index');
        }

        $category->status = $category->status == 1 ? 0 : 1;
        $category->updated_by = Auth::id() ?? 1;
        $category->updated_at = now();
        $category->save();

        return redirect()->route('category.index');
    }
}
