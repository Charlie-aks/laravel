<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;


class FeedbackController extends Controller
{
    public function index(){
        $list = Feedback::select('id','star','content')
        ->orderBy('created_at','desc')
        ->paginate(5);
        return view('backend.feedback.index',compact('list'));
    }
   
}
