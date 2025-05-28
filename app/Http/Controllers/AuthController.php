<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            return redirect()->route('site.home'); // Chuyển hướng đến trang chủ nếu đã đăng nhập
        }

        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'phone' => 'required|string|max:15|unique:user,phone',
            'username' => 'required|string|unique:user,username',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Tạo đối tượng User mới và gán giá trị từ request
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->roles = 'admin'; // Có thể tùy chỉnh thêm quyền
        $user->status = '1'; // Trạng thái người dùng

        // Lưu người dùng vào cơ sở dữ liệu
        $user->save();

        // chuyển sang trang đăng kí
        return redirect()->route('login')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập.');

    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            return redirect()->route('site.home'); // Chuyển hướng đến trang chủ nếu đã đăng nhập
        }

        return view('auth.login');
    }

    // Xử lý đăng nhập
   // Xử lý đăng nhập
  // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Lấy thông tin người dùng từ email
        $user = User::where('email', $request->email)->first();

        // Kiểm tra nếu người dùng tồn tại và mật khẩu có khớp không
        if ($user && Hash::check($request->password, $user->password)) {
            // Đăng nhập người dùng
            Auth::login($user);
            return redirect()->route('site.home');
        }

        // Nếu đăng nhập thất bại
        return redirect()->route('login')->withErrors(['email' => 'Tài khoản hoặc mật khẩu không đúng.']);
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');
    }
}
