<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy banner cho slideshow
        $slideshow = Banner::where('position', 'slideshow')
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Lấy banner cho sidebar
        $sidebar = Banner::where('position', 'sidebar')
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Lấy banner cho footer
        $footer = Banner::where('position', 'footer')
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('frontend.home', compact('slideshow', 'sidebar', 'footer'));
    }
}
