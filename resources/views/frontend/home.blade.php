<x-layout-site> 
  <x-slot:title> Trang Chu </x-slot:title> 
  <main>
     <!-- slider -->
     <div class="slider h-[650px] relative bg-center bg-cover px-6 flex flex-col items-center justify-center text-white text-4xl font-bold space-y-4" style="background-image: url('{{ asset('asset/img/slider.webp') }}');">
      <!-- Content slider-->                      
        <button class="w-60 h-12 px-5 py-2 bg-white text-xs text-black font-Karla rounded-none shadow-md uppercase hover:bg-orange-100 transition duration-300">
          Explore our product
        </button>  
    </div>
    <section>
      <!--Product New--> 
      <x-product-new/>
      <!--Product Sale--> 
      <x-product-sale/>
         <!-- video gioi thieu--> 
      <h2 class="text-2xl font-bold text-center mb-4">Brand introduction</h2>
      <div class="container mx-auto flex px-9 bg-zinc-50 ">
        <div class="flex justify-start">
          <video class="w-[700px] h-auto rounded-lg shadow-lg" controls>
            <source src="{{ asset('asset/video/intro.mp4') }}" type="video/mp4">
            Trình duyệt của bạn không hỗ trợ phát video.
          </video>
        </div>
        <div class="w-[700px] h-auto items-center mx-auto mt-[60px] space-y-5">
          <h1 class="font-medium text-2xl">ADORABLE DREAMS</h1>
          <p>This collection brings together Levents' dreamy spirit with Hello Kitty’s timeless adorableness.
            Designed for dreamers who find beauty in the little things, it serves as a gentle reminder that love,
            friendship, and imagination are the true colors of life.
            Step into a world where every piece tells a story of dreams, and every moment radiates cuteness.
            Be part of a journey that inspires you to dream boldly and love endlessly.</p>
        <!-- Cập nhật nút "Xem Thêm" -->
            <button class="w-[200px] h-[50px] bg-black text-white hover:bg-gray-700 hover-effect">
              <a href="">Xem thêm</a>
            </button>    
        </div>
        <!--ưu đãi-->
      </div>
      <div class="container mx-auto flex px-9 bg-zinc-50 my-[80px]">
        <div class="w-[700px] h-auto items-center mx-auto mt-[80px] space-y-5">
          <h1 class="font-medium text-2xl">ƯU ĐÃI MUA SẮM ĐẶC BIỆT</h1>
          <p>Giảm đến 50% | Voucher 30.000đ | Tặng thêm TÚI TOTE CANVAS</p>
        <!-- Cập nhật nút "Xem Thêm" -->
            <button class="w-[200px] h-[50px] bg-black text-white hover:bg-gray-700 hover-effect">
              <a href="">KHÁM PHÁ NGAY</a>
            </button>    
        </div>
        <div class="flex justify-start">
          <div class="w-[700px] h-auto rounded-lg shadow-lg" controls>
            <img src="{{ asset('asset/img/uudai.webp') }}" type="img">
          </div>
        </div>
      </div>
       <!--our collection -->
       <div class="container mx-auto mt-[80px]">
        <div class="swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide w-[426px] h-[221px]">
              <img src="{{asset('asset/img/slider.webp')}}" alt="">
              <p>LEVENTS® X HELLO KITTY - ADORABLE DREAMS</p>
            </div>
            <div class="swiper-slide w-[426px] h-[221px]">
              <img src="{{asset('asset/img/leventanniversary.webp')}}" alt="">
              <p>LEVENTS® X HELLO KITTY - ADORABLE DREAMS</p>
            </div>
            <div class="swiper-slide w-[426px] h-[221px]">
              <img src="{{asset('asset/img/shareyourcolor.webp')}}" alt="">
              <p>LEVENTS® X HELLO KITTY - ADORABLE DREAMS</p>
            </div>
            <div class="swiper-slide w-[426px] h-[221px]">
              <img src="{{asset('asset/img/3.webp')}}" alt="">
              <p>LEVENTS® X HELLO KITTY - ADORABLE DREAMS</p>
            </div>
            <div class="swiper-slide w-[426px] h-[221px]">
              <img src="{{asset('asset/img/5.webp')}}" alt="">
              <p>LEVENTS® X HELLO KITTY - ADORABLE DREAMS</p>
            </div>
          </div>        
          <!-- Nút điều hướng -->
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-pagination"></div>
        </div>
      </div>        
    </section>
  </main>
</x-layout-site>
   
   
 