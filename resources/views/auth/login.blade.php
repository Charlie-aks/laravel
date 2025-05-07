@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white shadow-2xl rounded-lg p-8">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">{{ __('Đăng nhập') }}</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Tên đăng nhập -->
            <div class="mb-6">
                <label for="email" class="block text-lg font-medium text-gray-800">{{ __('Email') }}</label>
                <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus
                       class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mật khẩu -->
            <div class="mb-6">
                <label for="password" class="block text-lg font-medium text-gray-800">{{ __('Mật khẩu') }}</label>
                <input id="password" type="password" name="password" required
                       class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Thông báo lỗi chung khi đăng nhập thất bại -->
            @if(session('error'))
                <div class="mb-4 text-red-500 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="text-center">
                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out">
                    {{ __('Đăng nhập') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
