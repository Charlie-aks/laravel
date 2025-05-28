<x-layout-site>
    <x-slot:title>Đăng nhập</x-slot:title>
    <main class="bg-gray-100 py-10">
        <div class="container mx-auto px-4">
            <div class="max-w-xl mx-auto bg-white shadow-2xl rounded-lg p-8">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">{{ __('Đăng nhập') }}</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Tên đăng nhập -->
                    <div class="mb-6">
                        <label for="email" class="block text-lg font-medium text-gray-800">{{ __('Email') }}</label>
                        <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mật khẩu -->
                    <div class="mb-6">
                        <label for="password" class="block text-lg font-medium text-gray-800">{{ __('Mật khẩu') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
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

                    <div class="space-y-4">
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out">
                            {{ __('Đăng nhập') }}
                        </button>

                        <div class="text-center">
                            <p class="text-gray-600 mb-2">Chưa có tài khoản?</p>
                            <a href="{{ route('register') }}" class="inline-block w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200 ease-in-out">
                                {{ __('Đăng ký ngay') }}
                            </a>
                        </div>
                    </div>
                </form>

                <div class="mt-4">
                    <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/>
                        </svg>
                        Đăng nhập bằng Google
                    </a>
                </div>

                <div class="flex items-center justify-center mt-4">
                    <a href="{{ route('facebook.login') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <i class="fab fa-facebook-f mr-2"></i> Đăng nhập bằng Facebook
                    </a>
                </div>
            </div>
        </div>
    </main>
</x-layout-site>
