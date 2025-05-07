<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
            </div>
            <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.orders.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.orders.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-shopping-cart mr-2"></i> Đơn hàng
                </a>
                <a href="{{ route('admin.product.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.product.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-box mr-2"></i> Sản phẩm
                </a>
                <a href="{{ route('admin.category.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.category.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-list mr-2"></i> Danh mục
                </a>
                <a href="{{ route('admin.brand.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.brand.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-tags mr-2"></i> Thương hiệu
                </a>
                <a href="{{ route('admin.user.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.user.*') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-users mr-2"></i> Người dùng
                </a>
                <a href="{{ route('logout') }}" class="block py-2 px-4 hover:bg-gray-700" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <div class="bg-white shadow">
                <div class="px-4 py-3">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold">@yield('title')</h2>
                        <div class="flex items-center">
                            <span class="mr-4">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-4">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>
</html> 