<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$header ?? 'Trang Admin'}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite('resources/css/app.css')
    {{$header ?? ''}}
</head>
<body class="bg-gray-400 text-gray-900">
    <header class="bg-[#4682B4] shadow-md">
        <div class="flex items-center justify-between p-4 text-white">
            <h1 class="text-2xl font-bold">Quản Lý</h1>
            <div class="flex items-center gap-4">
                <input type="text" placeholder="Tìm kiếm..." class="px-3 py-2 rounded-lg text-gray-200">
                <a href="#" class="flex items-center gap-2 hover:text-gray-200">
                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 hover:text-gray-200">
                        <i class="fa fa-power-off"></i> Đăng xuất
                    </button>
                </form>
            </div>
        </div>
    </header>
    <main class="flex">
        <aside class="w-1/5 bg-gray-600 text-white min-h-screen p-4">
            <ul class="space-y-2">
                <li><a class="block p-3 rounded-lg  hover:bg-blue-900" href="#">Bảng điều khiển</a></li>
                <li>
                    <a class="block p-3 rounded-lg  hover:bg-blue-900" href="#">Quản lý sản phẩm</a>
                    <ul class="ml-4 mt-1 space-y-1">
                        <li><a href="{{route('product.index')}}" class="block px-3 py-1 rounded-md hover:bg-blue-600">Sản phẩm</a></li>
                        <li><a href="{{route('category.index')}}" class="block px-3 py-1 rounded-md hover:bg-blue-600">Danh mục</a></li>
                        <li><a href="{{route('brand.index')}}" class="block px-3 py-1 rounded-md hover:bg-blue-600">Thương hiệu</a></li>
                        <li><a href="{{route('productsale.index')}}" class="block px-3 py-1 rounded-md hover:bg-blue-600">Sản phẩm khuyến mãi</a></li>
                        <li><a href="{{route('revenue.index')}}" class="block px-3 py-1 rounded-md hover:bg-blue-600">Thống kê doanh thu</a></li>
                    </ul>
                </li>
                <li>
                    <a class="block p-3 rounded-lg hover:bg-blue-900" href="#">Quản lý bài viết</a>
                    <ul class="ml-4 mt-1 space-y-1">
                        <li><a href="{{route('post.index')}}" class="block px-3 py-1 rounded-md hover:bg-blue-600">Bài viết</a></li>
                        <li><a href="{{route('topic.index')}}" class="block px-3 py-1 rounded-md hover:bg-blue-600">Chủ đề</a></li>
                    </ul>
                </li>
                <li><a class="block p-3 rounded-lg  hover:bg-blue-900" href="#">Giao diện</a></li>
                <li><a class="block p-3 rounded-lg  hover:bg-blue-900" href="{{route('contact.index')}}">Liên hệ</a></li>
                <li><a class="block p-3 rounded-lg  hover:bg-blue-900" href="{{route('menu.index')}}">Menu</a></li>
                <li><a class="block p-3 rounded-lg  hover:bg-blue-900" href="{{route('order.index')}}">Đơn hàng</a></li>
                <li><a class="block p-3 rounded-lg  hover:bg-blue-900" href="{{route('user.index')}}">Khách hàng</a></li>
                <li><a class="block p-3 rounded-lg  hover:bg-blue-900" href="{{route('feedback.index')}}">Đánh Giá</a></li>
            </ul>
        </aside>
        <section class="w-4/5 p-6 bg-white shadow-md rounded-lg m-4">
            {{$slot}}   
        </section>
    </main>
    <footer class="bg-white text-black text-center py-3 mt-6 shadow-md">
        <p>Thiết Kế bởi Đỗ Dương Phi</p>
    </footer>
    {{$footer ?? ''}}
</body>
</html>
