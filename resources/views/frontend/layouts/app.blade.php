<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang chủ') - {{ config('app.name') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('site.home') }}" class="text-2xl font-bold text-gray-800">
                    {{ config('app.name') }}
                </a>
                
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('site.home') }}" class="text-gray-600 hover:text-gray-900">Trang chủ</a>
                    <a href="{{ route('site.product') }}" class="text-gray-600 hover:text-gray-900">Sản phẩm</a>
                    <a href="{{ route('site.post.index') }}" class="text-gray-600 hover:text-gray-900">Bài viết</a>
                    <a href="{{ route('site.contact') }}" class="text-gray-600 hover:text-gray-900">Liên hệ</a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('site.cart') }}" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                    @auth
                        <a href="{{ route('logout') }}" class="text-gray-600 hover:text-gray-900">Đăng xuất</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900">Đăng ký</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-8">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Về chúng tôi</h3>
                    <p class="text-gray-300">
                        Chúng tôi cung cấp các sản phẩm chất lượng cao và dịch vụ tốt nhất cho khách hàng.
                    </p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Liên kết nhanh</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('site.home') }}" class="text-gray-300 hover:text-white">Trang chủ</a></li>
                        <li><a href="{{ route('site.product') }}" class="text-gray-300 hover:text-white">Sản phẩm</a></li>
                        <li><a href="{{ route('site.post.index') }}" class="text-gray-300 hover:text-white">Bài viết</a></li>
                        <li><a href="{{ route('site.contact') }}" class="text-gray-300 hover:text-white">Liên hệ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Liên hệ</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><i class="fas fa-map-marker-alt mr-2"></i> 123 Đường ABC, Quận XYZ, TP.HCM</li>
                        <li><i class="fas fa-phone mr-2"></i> (84) 123 456 789</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@example.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html> 