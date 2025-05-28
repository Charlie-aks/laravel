<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippingPolicyController extends Controller
{
    /**
     * Hiển thị trang chính sách vận chuyển
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.chinsachvanchuyen');
    }
}
