<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'title' => 'Tin nhắn từ người dùng',
            'content' => $validated['message'],
            'status' => 0,
            'slug' => Str::slug($validated['name'] . '-' . now()),
            'created_by' => 0,
        ]);

        return back()->with('success', 'Cảm ơn bạn đã gửi tin nhắn!');
    }
}
