<x-layout-site>
    <x-slot:title>Đăng ký</x-slot:title>
    <main class="bg-gray-100 py-10">
        <div class="container mx-auto px-4">
            <div class="max-w-xl mx-auto bg-white shadow-2xl rounded-lg p-8">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">{{ __('Đăng ký') }}</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Họ tên -->
                    <div class="mb-6">
                        <label for="name" class="block text-lg font-medium text-gray-800">{{ __('Họ tên') }}</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="block text-lg font-medium text-gray-800">{{ __('Email') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Số điện thoại -->
                    <div class="mb-6">
                        <label for="phone" class="block text-lg font-medium text-gray-800">{{ __('Số điện thoại') }}</label>
                        <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required autocomplete="tel"
                               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tên đăng nhập -->
                    <div class="mb-6">
                        <label for="username" class="block text-lg font-medium text-gray-800">{{ __('Tên đăng nhập') }}</label>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required autocomplete="username"
                               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 @error('username') border-red-500 @enderror">
                        @error('username')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mật khẩu -->
                    <div class="mb-6">
                        <label for="password" class="block text-lg font-medium text-gray-800">{{ __('Mật khẩu') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Xác nhận mật khẩu -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-lg font-medium text-gray-800">{{ __('Xác nhận mật khẩu') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 @error('password_confirmation') border-red-500 @enderror">
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Địa chỉ -->
                    <div class="mb-6">
                        <label for="address" class="block text-lg font-medium text-gray-800">{{ __('Địa chỉ') }}</label>
                        <input id="address" type="text" name="address" value="{{ old('address') }}" required autocomplete="street-address"
                               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror">
                        @error('address')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out">
                            {{ __('Đăng ký') }}
                        </button>

                        <div class="text-center">
                            <p class="text-gray-600 mb-2">Đã có tài khoản?</p>
                            <a href="{{ route('login') }}" class="inline-block w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200 ease-in-out">
                                {{ __('Đăng nhập ngay') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-layout-site>
