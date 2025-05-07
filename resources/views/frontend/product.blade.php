<x-layout-site>
  <x-slot:title>Tất cả sản phẩm</x-slot:title>

  <main class="bg-white">
    <section class="container mx-auto px-6 py-10">
      <h1 class="text-3xl font-extrabold text-center text-gray-800 uppercase mb-10">
        @if(isset($keyword))
          Kết quả tìm kiếm cho: "{{ $keyword }}"
        @else
          Tất cả sản phẩm
        @endif
      </h1>

      {{-- Thanh tìm kiếm --}}
      <div class="max-w-2xl mx-auto mb-10">
        <form action="{{ route('site.product.search') }}" method="GET" class="flex items-center">
          <input type="text" name="keyword" placeholder="Nhập tên sản phẩm cần tìm..." 
              class="flex-1 border border-gray-300 rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
              value="{{ request('keyword') }}">
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700">
              <i class="fa-solid fa-search"></i> Tìm kiếm
          </button>
        </form>
      </div>

      @if(isset($keyword) && $product_list->isEmpty())
        <div class="text-center py-10">
          <p class="text-gray-600 text-lg">Không tìm thấy sản phẩm phù hợp với từ khóa "{{ $keyword }}"</p>
          <a href="{{ route('site.product') }}" class="text-blue-600 hover:underline mt-4 inline-block">
            Quay lại trang sản phẩm
          </a>
        </div>
      @else
        {{-- Danh sách category và brand --}}
        <div class="mb-10">
          <x-category-list />
          <x-brand-list />
        </div>

        {{-- Danh sách sản phẩm --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          @foreach ($product_list as $product)
            @include('components.product-card', ['product' => $product])
          @endforeach
        </div>
      @endif
    </section>
  </main>
</x-layout-site>