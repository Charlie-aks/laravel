<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')
                ->scopes(['email', 'profile'])
                ->redirect();
        } catch (Exception $e) {
            Log::error('Google redirect error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Không thể kết nối với Google. Vui lòng thử lại sau.');
        }
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            // Log thông tin user để debug
            Log::info('Google user info:', [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'avatar' => $user->avatar
            ]);

            try {
                $finduser = User::where('google_id', $user->id)->first();
                Log::info('Find user by google_id:', ['user' => $finduser]);

                if ($finduser) {
                    Auth::login($finduser);
                    Log::info('Login existing user with google_id');
                    return redirect()->intended(route('site.home'))->with('success', 'Đăng nhập bằng Google thành công!');
                } else {
                    // Kiểm tra xem email đã tồn tại chưa
                    $existingUser = User::where('email', $user->email)->first();
                    Log::info('Find user by email:', ['user' => $existingUser]);
                    
                    if ($existingUser) {
                        try {
                            // Cập nhật google_id cho user hiện có
                            $existingUser->google_id = $user->id;
                            $existingUser->avatar = $user->avatar;
                            $existingUser->save();
                            Log::info('Updated existing user with google_id');
                            
                            Auth::login($existingUser);
                            return redirect()->intended(route('site.home'))->with('success', 'Đăng nhập bằng Google thành công!');
                        } catch (\Exception $e) {
                            Log::error('Error updating existing user: ' . $e->getMessage());
                            throw $e;
                        }
                    } else {
                        try {
                            // Tạo user mới
                            $newUser = User::create([
                                'name' => $user->name,
                                'email' => $user->email,
                                'google_id' => $user->id,
                                'password' => bcrypt(uniqid()),
                                'avatar' => $user->avatar,
                                'roles' => 'customer',
                                'status' => '1',
                                'phone' => '0' . rand(100000000, 999999999), // Tạo số điện thoại ngẫu nhiên
                                'username' => explode('@', $user->email)[0], // Tạo username từ email
                                'address' => 'Chưa cập nhật' // Địa chỉ mặc định
                            ]);
                            Log::info('Created new user with google_id');

                            Auth::login($newUser);
                            return redirect()->intended(route('site.home'))->with('success', 'Đăng nhập bằng Google thành công!');
                        } catch (\Exception $e) {
                            Log::error('Error creating new user: ' . $e->getMessage());
                            throw $e;
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error('Database operation error: ' . $e->getMessage());
                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Google callback error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('Error occurred in file: ' . $e->getFile() . ' on line: ' . $e->getLine());
            return redirect()->route('login')
                ->with('error', 'Đăng nhập bằng Google thất bại: ' . $e->getMessage());
        }
    }
} 