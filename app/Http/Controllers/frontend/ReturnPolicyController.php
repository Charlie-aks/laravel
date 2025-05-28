<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReturnPolicyController extends Controller
{
    /**
     * Hiển thị trang chính sách đổi trả
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.chinhsachdoitra');
    }
}
