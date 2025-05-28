<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Post::select('id', 'title', 'detail', 'thumbnail', 'description')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.post.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $request->validate([
            'topic_id'     => 'required|integer',
            'title'        => 'required|string|max:255',
            'slug'         => 'nullable|string|max:255',
            'detail'       => 'nullable|string',
            'thumbnail'    => 'nullable|image|max:2048',
            'type'         => 'required|string|max:50',
            'description'  => 'nullable|string|max:500',
            'status'       => 'required|in:0,1',
        ]);

        $post = new Post();
        $post->topic_id = $request->topic_id;
        $post->title = $request->title;
        $post->slug = $request->slug ?? Str::slug($request->title);
        $post->detail = $request->detail;
        $post->type = $request->type;
        $post->description = $request->description;
        $post->status = $request->status;
        $post->created_by = Auth::id() ?? 1;
        $post->updated_by = Auth::id() ?? 1;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/posts'), $filename);
            $post->thumbnail = 'assets/images/posts/' . $filename;
        }

        $post->save();

        return redirect()->route('post.index')->with('success', 'Thêm bài viết thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Bài viết không tồn tại');
        }
        return view('backend.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Không tìm thấy bài viết.');
        }

        // Debug thông tin file upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            \Log::info('File upload info:', [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
                'is_valid' => $file->isValid()
            ]);
        }

        $request->validate([
            'topic_id'    => 'nullable|integer',
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255',
            'detail'      => 'nullable|string',
            'thumbnail'   => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'type'        => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
            'status'      => 'required|in:0,1',
        ], [
            'thumbnail.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, webp',
            'thumbnail.max' => 'Kích thước hình ảnh không được vượt quá 2MB'
        ]);

        $post->topic_id = $request->topic_id ?? $post->topic_id;
        $post->title = $request->title;
        $post->slug = $request->slug ?? Str::slug($request->title);
        $post->detail = $request->detail;
        $post->type = $request->type ?? $post->type;
        $post->description = $request->description;
        $post->status = $request->status;
        $post->updated_by = Auth::id() ?? 1;

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                File::delete(public_path($post->thumbnail));
            }
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $filename);
            $post->thumbnail = 'uploads/posts/' . $filename;
        }

        $post->save();

        return redirect()->route('post.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return redirect()->route('post.index')->with('success', 'Xóa bài viết thành công!');
        }
        return redirect()->route('post.index')->with('error', 'Không tìm thấy bài viết để xóa!');
    }
}
