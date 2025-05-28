<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuyingGuideController extends Controller
{
    /**
     * Hiển thị trang hướng dẫn mua hàng
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.huongdanmuahang');
    }
}
