<x-layout-site>
    <x-slot:title>Đăng nhập</x-slot:title>
    
    <main class="bg-gray-50 min-h-screen py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Đăng nhập</h2>

                    <div class="text-center mb-6">
                        <a href="{{ route('register') }}" 
                           class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg transition duration-200 ease-in-out">
                            Đăng ký tài khoản mới
                        </a>
                    </div>

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div class="mb-6">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mật khẩu</label>
                            <input type="password" name="password" id="password" autocomplete="current-password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-900">Ghi nhớ đăng nhập</label>
                            </div>
                            <a href="#" class="text-sm text-blue-500 hover:text-blue-600">Quên mật khẩu?</a>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" 
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Đăng nhập
                            </button>
                        </div>

                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-600">
                                Chưa có tài khoản? 
                                <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-600">Đăng ký</a>
                            </p>
                        </div>
                    </form>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Hoặc đăng nhập bằng</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <a href="{{ route('google.login') }}" 
                               class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <svg class="w-5 h-5" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/>
                                </svg>
                                <span class="ml-2">Đăng nhập bằng Google</span>
                            </a>

                            <a href="{{ secure_url(route('facebook.login')) }}" 
                               class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <svg class="w-5 h-5 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                <span class="ml-2">Đăng nhập bằng Facebook</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout-site> 