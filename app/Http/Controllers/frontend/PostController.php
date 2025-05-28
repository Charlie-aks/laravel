<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('frontend.post.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
        return view('frontend.post.show', compact('post'));
    }
} 