<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $list = Banner::select('id', 'name', 'image', 'description', 'link', 'position', 'sort_order', 'status')
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
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'position' => $request->position,
            'sort_order' => $request->sort_order ?? 1,
            'status' => $request->status,
            'created_by' => Auth::id() ?? 1,
            'created_at' => now()
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        Banner::create($data);

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

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'position' => $request->position,
            'status' => $request->status,
            'updated_by' => Auth::id() ?? 1,
            'updated_at' => now()
        ];

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            // Lưu ảnh mới
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('banner.index')->with('success', 'Cập nhật banner thành công!');
    }

    public function destroy(string $id)
    {
        $banner = Banner::onlyTrashed()->find($id);
        if ($banner == null) {
            return redirect()->route('banner.trash');
        }

        if ($banner->forceDelete()) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
        }
        return redirect()->route('banner.trash')->with('success', 'Xóa vĩnh viễn banner thành công');
    }

    public function delete($id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            return redirect()->route('banner.index');
        }
        $banner->delete();
        return redirect()->route('banner.index')->with('success', 'Xóa banner thành công');
    }
    
    public function trash()
    {
        $list = Banner::onlyTrashed()
            ->select('id', 'name', 'status', 'deleted_at', 'image')
            ->orderBy('deleted_at', 'desc')
            ->paginate(5);
    
        return view('backend.banner.trash', compact('list'));
    }

    public function restore($id)
    {
        $banner = Banner::onlyTrashed()->find($id);
        if ($banner) {
            $banner->restore();
            return redirect()->route('banner.trash')->with('success', 'Khôi phục banner thành công');
        }
        return redirect()->route('banner.trash');
    }

    public function status($id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            return redirect()->route('banner.index');
        }
        $banner->status = $banner->status == 1 ? 0 : 1;
        $banner->updated_by = Auth::id() ?? 1;
        $banner->updated_at = now();
        $banner->save();
        return redirect()->route('banner.index')->with('success', 'Cập nhật trạng thái banner thành công');
    }
}
