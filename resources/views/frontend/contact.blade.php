<x-layout-site>
  <x-slot:title>Lien He</x-slot:title>
  <main class="bg-gray-100 py-10">
    <section class="px-10 max-w-6xl mx-auto">
      <h1 class="uppercase text-2xl font-bold px-5 text-gray-800">Thông tin các cửa hàng</h1>
      <div class="container mx-auto px-5 flex space-x-4 border-b pb-5 mt-5">
        <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
          <img src="{{asset('asset/img/levent11.webp')}}" alt="" class="rounded-md w-full h-48 object-cover">
          <p class="uppercase font-semibold mt-3 text-gray-700">Sư vạn hạnh, quận 10</p>
          <p class="text-gray-600">842 Sư Vạn Hạnh, Phường 12, Quận 10, HCM</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
          <img src="{{asset('asset/img/levent13.webp')}}" alt="" class="rounded-md w-full h-48 object-cover">
          <p class="uppercase font-semibold mt-3 text-gray-700">Sư vạn hạnh, quận 10</p>
          <p class="text-gray-600">842 Sư Vạn Hạnh, Phường 12, Quận 10, HCM</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
          <img src="{{asset('asset/img/shareyourcolor.webp')}}" alt="" class="rounded-md w-full h-48 object-cover">
          <p class="uppercase font-semibold mt-3 text-gray-700">Sư vạn hạnh, quận 10</p>
          <p class="text-gray-600">842 Sư Vạn Hạnh, Phường 12, Quận 10, HCM</p>
        </div>
      </div>
      
      <div class="flex flex-wrap my-10 gap-10">
        <div class="space-y-4 w-full md:w-1/2">
          <h1 class="font-semibold text-xl text-gray-800">Thông tin liên hệ</h1>
          <div class="space-y-3">
            <div class="flex justify-between items-center border-b pb-2">
              <p class="text-gray-700">Hotline: 1900 633028</p>
              <button class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition">Gọi ngay</button>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
              <p class="text-gray-700">Email khách hàng: customercare@levents.asia</p>
              <button class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition">Gửi mail</button>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
              <p class="text-gray-700">Email kinh doanh: business@levents.asia</p>
              <button class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition">Gửi mail</button>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
              <p class="text-gray-700">Email tuyển dụng: hr@levents.asia</p>
              <button class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition">Gửi mail</button>
            </div>
          </div>
        </div>
        
        <div class="space-y-4 w-full md:w-1/2">
          <h1 class="text-xl font-semibold text-gray-800">Gửi tin nhắn cho chúng tôi</h1>
          <input type="text" placeholder="Nhập tên của bạn" class="border p-2 w-full rounded-lg focus:ring-2 focus:ring-blue-500">
          <input type="email" placeholder="Nhập email của bạn" class="border p-2 w-full rounded-lg focus:ring-2 focus:ring-blue-500">
          <input type="tel" placeholder="Nhập SĐT của bạn" class="border p-2 w-full rounded-lg focus:ring-2 focus:ring-blue-500">
          <textarea placeholder="Nhập bình luận của bạn..." rows="4" class="border p-2 w-full rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
          <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">Gửi tin nhắn</button>
        </div>
      </div>
    </section>
  </main>
</x-layout-site>