<x-layout-site>
  <x-slot:title>Detail</x-slot:title>
  <main class="bg-white text-gray-900">
    <div class="max-w-6xl mx-auto p-4">
        {{-- Chi tiết sản phẩm --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-6 rounded-xl shadow-md">
            {{-- Hình ảnh --}}
            <div>
                <div class="grid grid-cols-1 gap-4">
                    {{-- Ảnh chính --}}
                    <div class="relative">
                        @php
                            $mainImage = $product_item->productimage->first();
                            $imageName = $mainImage ? $mainImage->thumbnail : 'default-thumbnail.jpg';
                            $imagePath = 'assets/images/product/' . $imageName;
                            $fullPath = public_path($imagePath);
                            
                            if (!file_exists($fullPath)) {
                                \Log::error('Image not found: ' . $fullPath);
                                $imagePath = 'assets/images/product/default-thumbnail.jpg';
                            }
                        @endphp
                        <img src="{{ asset($imagePath) }}"
                             alt="{{ $product_item->name }}"
                             id="main-image"
                             class="w-full h-[450px] object-cover rounded-lg shadow-sm">
                    </div>

                    {{-- Thumbnail gallery --}}
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product_item->productimage as $image)
                            <div class="relative group cursor-pointer">
                                <img src="{{ asset('assets/images/product/' . $image->thumbnail) }}"
                                     alt="{{ $product_item->name }}"
                                     onclick="changeMainImage(this.src)"
                                     class="w-full h-24 object-cover rounded-lg hover:opacity-75 transition-opacity">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    
            {{-- Thông tin sản phẩm --}}
            <div class="flex flex-col">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product_item->name }}</h1>
                
                {{-- Giá --}}
                <div class="flex items-center space-x-4 mb-6">
                    <span class="text-2xl text-yellow-600 font-semibold">
                        {{ number_format($product_item->sale ? $product_item->sale->price_sale : $product_item->price_root, 0, ',', '.') }}₫
                    </span>
                    @if ($product_item->price_root && $product_item->sale && $product_item->sale->price_sale < $product_item->price_root)
                        <span class="text-lg line-through text-gray-400">
                            {{ number_format($product_item->price_root, 0, ',', '.') }}₫
                        </span>
                        <span class="text-sm text-red-500 font-medium">
                            -{{ round((($product_item->price_root - $product_item->sale->price_sale) / $product_item->price_root) * 100) }}%
                        </span>
                    @endif
                </div>
    
                {{-- Nút thêm vào giỏ --}}
                <div class="mt-4">
                    <form action="{{ route('cart.addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product_item->id }}">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <label for="size" class="mr-2">Size:</label>
                                <select name="size" id="size" class="border border-gray-300 rounded px-2 py-1">
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                </select>
                            </div>
                            <div class="flex items-center">
                                <label for="quantity" class="mr-2">Số lượng:</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" 
                                    class="w-20 border border-gray-300 rounded px-2 py-1">
                            </div>
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition duration-300">
                                <i class="fa-solid fa-cart-plus mr-2"></i> Thêm vào giỏ hàng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        {{-- Sản phẩm liên quan --}}
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Sản phẩm liên quan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($product_list as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </div>
</main>

<script>
    function changeMainImage(src) {
        document.getElementById('main-image').src = src;
    }
</script>
</x-layout-site>