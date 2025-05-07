<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'status' => 'required|in:0,1',
        ]);

        $imagePath = $request->file('image')->store('banners', 'public');

        Banner::create([
            'name' => $request->name,
            'image' => $imagePath,
            'link' => $request->link,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.banner.index')
            ->with('success', 'Thêm banner thành công');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'status' => 'required|in:0,1',
        ]);

        $banner = Banner::findOrFail($id);
        $data = [
            'name' => $request->name,
            'link' => $request->link,
            'status' => $request->status,
        ];

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            Storage::disk('public')->delete($banner->image);
            // Lưu ảnh mới
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.banner.index')
            ->with('success', 'Cập nhật banner thành công');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        Storage::disk('public')->delete($banner->image);
        $banner->delete();

        return redirect()->route('admin.banner.index')
            ->with('success', 'Xóa banner thành công');
    }

    public function trash()
    {
        $banners = Banner::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('admin.banners.trash', compact('banners'));
    }

    public function restore($id)
    {
        $banner = Banner::onlyTrashed()->findOrFail($id);
        $banner->restore();

        return redirect()->route('admin.banner.trash')
            ->with('success', 'Khôi phục banner thành công');
    }

    public function delete($id)
    {
        $banner = Banner::onlyTrashed()->findOrFail($id);
        Storage::disk('public')->delete($banner->image);
        $banner->forceDelete();

        return redirect()->route('admin.banner.trash')
            ->with('success', 'Xóa vĩnh viễn banner thành công');
    }

    public function status($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update(['status' => !$banner->status]);

        return redirect()->back()
            ->with('success', 'Cập nhật trạng thái banner thành công');
    }
} 