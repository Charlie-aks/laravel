<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>{{$title ?? 'Levent'}}</title>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Xử lý dropdown menu
        const toggleDropdown = document.getElementById("toggleDropdown");
        const dropdownMenu = document.getElementById("dropdownMenu");
    
        if (toggleDropdown && dropdownMenu) {
          toggleDropdown.addEventListener("click", function (e) {
            e.preventDefault();
            dropdownMenu.classList.toggle("hidden");
            dropdownMenu.classList.toggle("fade-in"); // Hiệu ứng mở menu
          });
    
          document.addEventListener("click", function (e) {
            if (!toggleDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
              dropdownMenu.classList.add("hidden");
              dropdownMenu.classList.remove("fade-in"); // Ẩn hiệu ứng khi menu đóng
            }
          });
        }
    
        // Khởi tạo Swiper.js
        new Swiper(".swiper", {
          slidesPerView: 3, // Số ảnh hiển thị cùng lúc
          spaceBetween: 20, // Khoảng cách giữa các ảnh
          loop: true, // Vòng lặp vô hạn
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
        });
      });
    </script>
    @vite('resources/css/app.css')
    {{$header ?? ''}}
  </head>
  <body>
    <!-- Thông báo flash message -->
    @if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('error') }}
    </div>
    @endif

    <!-- header -->
    <header>
      <div class="container mx-auto bg-black h-[40px] flex items-center justify-center">
        <p class="text-white font-bold text-sm">Levents loves you <3</p>
      </div>
      <div class="container mx-auto flex items-center py-4">
        <!-- Logo -->
        <div class="w-2/6 pl-40">
          <a href="{{ route('site.home') }}">
            <img src="{{ asset('asset/img/logo1.png') }}" class="w-[170px] h-[35px] cursor-pointer" alt="logo">
          </a>
        </div>
        <!-- Navbar -->
        <x-main-menu/>
        <!-- Search + Cart -->
        <div class="w-2/6 flex justify-end pr-40 items-center space-x-4">
          <!-- Search Bar -->
          <!-- Cart -->
          <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
            <a href="{{ route('site.cart') }}" class="flex items-center space-x-1">
              <span class="relative after:absolute after:left-0 after:bottom-[-2px] after:w-0 after:h-[2px] after:bg-orange-200 after:transition-all after:duration-300 hover:after:w-full">Cart</span>
              <x-cart-count />
            </a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="text-red-500 hover:underline">Đăng xuất</button>
          </form>
          </div>
        </div>
      </div>
     
    </header>
    {{$slot}}
    <!--footer-->
    <footer>
      <div class="container mx-auto mt-10 px-5 flex border-b-[1px] text-sm bg-amber-50 py-5">
        <div class="space-y-2 pr-[500px]">
          <img src="{{asset('asset/img/logo2.avif')}}" alt="" class="w-[170px] h-[35px]">
          <p>Levents® - Share your Color</p>
          <button class="w-40 h-10 px-5 py-2 bg-gray-100 text-xs text-black font-Karla rounded-none shadow-md hover:bg-orange-100 transition duration-300 cursor-pointer">
            xem ngay  
          </button>
        </div>
        <div class="flex space-x-4">
          <ul class="space-y-5">
            <a href="{{route('site.contact') }}"><li>Lien he</li></a>
            <li>Hotline
              1900 633 028</li>
            <li>Email for customer
              customercare@levents.asia</li>
            <li>Email for business
              business@levents.asia</li>
            <li>Email for recruitment
              hr-admin@levents.asia</li>
            <li></li>
          </ul>           
          <ul class="space-y-5">
            <li>Cửa hàng</li>
            <li>139E Nguyễn Trãi, Phường Bến Thành, Quận 1, HCM</li>
            <li>842 Sư Vạn Hạnh, phường 12, quận 10, HCM</li>
            <li>54 Mậu Thân, An Phú, quận Ninh Kiều, Cần Thơ </li>
            <li>Hộ Kinh doanh Red Label - MST: 41J8031547</li>
            <li></li>
          </ul>      
          <ul class="space-y-5">
            <li><a href="">Hỗ trợ</a></li>
            <li><a href="{{route('return.policy')}}">Chính sách đổi trả</a></li>
            <li><a href="{{route('shipping.policy')}}">Chính sách vận chuyển</a></li>
            <li><a href="{{route('warranty.policy')}}">Chính sách bảo hành</a></li>
            <li><a href="{{route('buying.guide')}}">Hướng dẫn mua hàng</a></li>
            <ul class="flex">
            <li><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 30 30">
              <path d="M15,3C8.373,3,3,8.373,3,15c0,6.016,4.432,10.984,10.206,11.852V18.18h-2.969v-3.154h2.969v-2.099
                       c0-3.475,1.693-5,4.581-5c1.383,0,2.115,0.103,2.461,0.149v2.753h-1.97c-1.226,0-1.654,1.163-1.654,2.473v1.724h3.593
                       L19.73,18.18h-3.106v8.697C22.481,26.083,27,21.075,27,15C27,8.373,21.627,3,15,3z"></path>
            </svg></li>
            <li>
              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 30 30">
                <path d="M 9.9980469 3 C 6.1390469 3 3 6.1419531 3 10.001953 L 3 20.001953 C 3 23.860953 6.1419531 27 10.001953 27 L 20.001953 27 C 23.860953 27 27 23.858047 27 19.998047 L 27 9.9980469 C 27 6.1390469 23.858047 3 19.998047 3 L 9.9980469 3 z M 22 7 C 22.552 7 23 7.448 23 8 C 23 8.552 22.552 9 22 9 C 21.448 9 21 8.552 21 8 C 21 7.448 21.448 7 22 7 z M 15 9 C 18.309 9 21 11.691 21 15 C 21 18.309 18.309 21 15 21 C 11.691 21 9 18.309 9 15 C 9 11.691 11.691 9 15 9 z M 15 11 A 4 4 0 0 0 11 15 A 4 4 0 0 0 15 19 A 4 4 0 0 0 19 15 A 4 4 0 0 0 15 11 z"></path>
            </svg>
            </li>
            <li>
              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 24 24">
                <path d="M21.582,6.186c-0.23-0.86-0.908-1.538-1.768-1.768C18.254,4,12,4,12,4S5.746,4,4.186,4.418 c-0.86,0.23-1.538,0.908-1.768,1.768C2,7.746,2,12,2,12s0,4.254,0.418,5.814c0.23,0.86,0.908,1.538,1.768,1.768 C5.746,20,12,20,12,20s6.254,0,7.814-0.418c0.861-0.23,1.538-0.908,1.768-1.768C22,16.254,22,12,22,12S22,7.746,21.582,6.186z M10,14.598V9.402c0-0.385,0.417-0.625,0.75-0.433l4.5,2.598c0.333,0.192,0.333,0.674,0,0.866l-4.5,2.598 C10.417,15.224,10,14.983,10,14.598z"></path>
              </svg>
            </li>
            <li>
              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 30 30">
                <path d="M24,4H6C4.895,4,4,4.895,4,6v18c0,1.105,0.895,2,2,2h18c1.105,0,2-0.895,2-2V6C26,4.895,25.104,4,24,4z M22.689,13.474 c-0.13,0.012-0.261,0.02-0.393,0.02c-1.495,0-2.809-0.768-3.574-1.931c0,3.049,0,6.519,0,6.577c0,2.685-2.177,4.861-4.861,4.861 C11.177,23,9,20.823,9,18.139c0-2.685,2.177-4.861,4.861-4.861c0.102,0,0.201,0.009,0.3,0.015v2.396c-0.1-0.012-0.197-0.03-0.3-0.03 c-1.37,0-2.481,1.111-2.481,2.481s1.11,2.481,2.481,2.481c1.371,0,2.581-1.08,2.581-2.45c0-0.055,0.024-11.17,0.024-11.17h2.289 c0.215,2.047,1.868,3.663,3.934,3.811V13.474z"></path>
              </svg>
            </li>
          </ul>
          </ul>
      </div>   
      <div class="">Made In DoDuongPhi. © 2025.</div>
    </footer>
    {{$footer ?? ''}}
  </body>  
</html>
