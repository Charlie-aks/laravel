<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Log;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        try {
            Log::info('Redirecting to Facebook...');
            return Socialite::driver('facebook')
                ->scopes(['email', 'public_profile'])
                ->stateless()
                ->redirect();
        } catch (Exception $e) {
            Log::error('Facebook redirect error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Không thể kết nối với Facebook. Vui lòng thử lại sau.');
        }
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')
                ->stateless()
                ->user();
            
            Log::info('Facebook user info:', [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'avatar' => $user->avatar
            ]);

            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                Log::info('Login existing user with facebook_id');
                return redirect()->intended(route('site.home'))->with('success', 'Đăng nhập bằng Facebook thành công!');
            } else {
                // Kiểm tra xem email đã tồn tại chưa
                $existingUser = User::where('email', $user->email)->first();
                
                if ($existingUser) {
                    // Cập nhật facebook_id cho user hiện có
                    $existingUser->facebook_id = $user->id;
                    $existingUser->avatar = $user->avatar;
                    $existingUser->save();
                    Log::info('Updated existing user with facebook_id');
                    
                    Auth::login($existingUser);
                    return redirect()->intended(route('site.home'))->with('success', 'Đăng nhập bằng Facebook thành công!');
                } else {
                    // Tạo user mới
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'facebook_id' => $user->id,
                        'password' => bcrypt(uniqid()),
                        'avatar' => $user->avatar,
                        'roles' => 'customer',
                        'status' => '1',
                        'phone' => '0' . rand(100000000, 999999999), // Tạo số điện thoại ngẫu nhiên
                        'username' => explode('@', $user->email)[0], // Tạo username từ email
                        'address' => 'Chưa cập nhật' // Địa chỉ mặc định
                    ]);
                    Log::info('Created new user with facebook_id');

                    Auth::login($newUser);
                    return redirect()->intended(route('site.home'))->with('success', 'Đăng nhập bằng Facebook thành công!');
                }
            }
        } catch (Exception $e) {
            Log::error('Facebook callback error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->route('login')
                ->with('error', 'Đăng nhập bằng Facebook thất bại: ' . $e->getMessage());
        }
    }
} 