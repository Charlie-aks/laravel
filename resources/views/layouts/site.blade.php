<header class="bg-white shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            <div class="flex items-center space-x-8">
                <a href="{{ route('site.home') }}" class="text-2xl font-bold text-blue-600">
                    Logo
                </a>
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('site.home') }}" class="text-gray-600 hover:text-blue-600">Trang chủ</a>
                    <a href="{{ route('site.product') }}" class="text-gray-600 hover:text-blue-600">Sản phẩm</a>
                    <a href="{{ route('site.about') }}" class="text-gray-600 hover:text-blue-600">Giới thiệu</a>
                    <a href="{{ route('site.contact') }}" class="text-gray-600 hover:text-blue-600">Liên hệ</a>
                </nav>
            </div>
            
            <div class="flex items-center space-x-4">
                <form action="{{ route('site.product.search') }}" method="GET" class="flex items-center">
                    <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." 
                        class="border border-gray-300 rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-64"
                        value="{{ request('keyword') }}">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </form>
                
                <a href="{{ route('site.cart') }}" class="text-gray-600 hover:text-blue-600">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                    <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1">
                        {{ count(session('cart', [])) }}
                    </span>
                </a>
            </div>
        </div>
    </div>
</header> 