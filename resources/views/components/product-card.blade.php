{{-- components/product-card.blade.php --}}
<div class="product-card bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden flex flex-col w-full transition-transform duration-300 hover:-translate-y-1 hover:shadow-md">
    <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}" class="relative">
        @php
            // Lấy ảnh từ relationship productimage hoặc query trực tiếp nếu không có relationship
            $productImage = null;
            if (isset($product->productimage)) {
                $productImage = $product->productimage->first();
            } else {
                $productImage = DB::table('productimage')
                    ->where('product_id', $product->id)
                    ->first();
            }
            
            $imageName = $productImage ? $productImage->thumbnail : 'default-thumbnail.jpg';
            $imagePath = 'assets/images/product/' . $imageName;
            $fullPath = public_path($imagePath);
            
            // Debug thông tin
            \Log::info('Product ID: ' . $product->id);
            \Log::info('Image Name: ' . $imageName);
            \Log::info('Image Path: ' . $imagePath);
            \Log::info('Full Path: ' . $fullPath);
            
            // Kiểm tra file tồn tại
            if (!file_exists($fullPath)) {
                \Log::error('Image not found: ' . $fullPath);
                $imagePath = 'assets/images/product/default-thumbnail.jpg';
            }
        @endphp
        <img src="{{ asset($imagePath) }}" alt="{{ $product->name }}"
        class="w-full h-[250px] object-cover transition-transform duration-500">
        @if ($product->price_root && $product->price_sale < $product->price_root)
            <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-medium px-2 py-1 rounded">
                -{{ round((($product->price_root - $product->price_sale) / $product->price_root) * 100) }}%
            </span>
        @endif
    </a>

    <div class="p-4 flex flex-col flex-1">
        <h3 class="text-base font-semibold text-gray-800 hover:text-blue-600 transition-colors duration-200 mb-2">
            <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">
                {{ \Illuminate\Support\Str::limit($product->name, 50) }}
            </a>
        </h3>

        <div class="flex justify-between items-center mt-4">
            <span class="text-lg font-bold text-yellow-600">
                {{ number_format($product->price_sale, 0, ',', '.') }}₫
            </span>
            @if ($product->price_root)
                <span class="text-sm text-gray-400 line-through ml-2">
                    {{ number_format($product->price_root, 0, ',', '.') }}₫
                </span>
            @endif
        </div>

        <div class="mt-auto flex items-center justify-between">
            <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}"
                class="text-blue-500 text-sm font-medium hover:underline">
                Xem chi tiết
            </a>
        </div>
    </div>
</div>

