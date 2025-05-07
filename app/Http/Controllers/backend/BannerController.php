<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index()
    {
        $list = Banner::select('id', 'name', 'image', 'description','status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.banner.index', compact('list'));
    }

    public function create()
    {
        return view('backend.banner.create');
    }

    public function store(StoreBannerRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/images/banner'), $imageName);
            $imagePath = 'assets/images/banner/' . $imageName;
        }

        $banner = new Banner();
        $banner->name = $request->name;
        $banner->description = $request->description;
        $banner->image = $imagePath;
        $banner->position = $request->position;
        $banner->sort_order = $request->sort_order ?? 1;
        $banner->status = $request->status;
        $banner->created_by = Auth::id() ?? 1;
        $banner->created_at = now();
        $banner->save();

        return redirect()->route('banner.index')->with('success', 'Thêm banner thành công');
    }

    public function edit(string $id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return redirect()->route('banner.index')->with('error', 'Banner không tồn tại');
        }
        return view('backend.banner.edit', compact('banner'));
    }

    public function update(Request $request, string $id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return redirect()->route('banner.index')->with('error', 'Không tìm thấy banner');
        }

        $banner->name = $request->name;
        $banner->description = $request->description;
        $banner->position = $request->position;
        $banner->status = $request->status;
        $banner->updated_by = Auth::id() ?? 1;
        $banner->updated_at = now();

        // Cập nhật ảnh mới nếu có
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Xóa ảnh cũ nếu có
            if ($banner->image && File::exists(public_path($banner->image))) {
                File::delete(public_path($banner->image));
            }

            // Lưu ảnh mới
            $file->move(public_path('assets/images/banner'), $fileName);
            $banner->image = 'assets/images/banner/' . $fileName;
        }

        $banner->save();

        return redirect()->route('banner.index')->with('success', 'Cập nhật banner thành công!');
    }
    public function destroy(string $id)
    {
        $banner = Banner::onlyTrashed()->find($id);
        if($banner==null)
        {
            return redirect()->route('banner.trash');
        }
        $image_path = public_path('assets/images/banner'.$banner->image);
        if($banner->forceDelete())
        {
            if(File::exists($image_path)){
                File::delete($image_path);
            }
        }
        return redirect()->route('banner.trash');
    }

    public function delete($id)
    {
        $banner = Banner::find($id);
        if($banner==null)
        {
            return redirect()->route('banner.index');
        }
        $banner->delete();
        return redirect()->route('banner.index');
    }
    
    public function trash()
    {
        $list = Banner::onlyTrashed()
            ->select('id', 'name', 'status', 'deleted_at','image')
            ->orderBy('deleted_at', 'desc')
            ->paginate(5);
    
        return view('backend.banner.trash', compact('list'));
    }
    public function restore($id)
    {
        $banner = Banner::onlyTrashed()->find($id);
        if ($banner) {
            $banner->restore();
        }
        return redirect()->route('banner.trash');
    }
    public function status($id){
        $banner = Banner::find($id);
        if($banner == null )
        {
            return redirect()->route('banner.index');
        }
        $banner->status = $banner->status == 1 ? 0 : 1;
        $banner->updated_by = Auth::id() ?? 1;
        $banner->updated_at = now();
        $banner->save();
        return redirect()->route('banner.index');
    }
}
