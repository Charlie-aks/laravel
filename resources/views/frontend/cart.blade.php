<x-layout-site>
  <x-slot:title>Gio Hang</x-slot:title>
  <main class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-3xl">
        <h2 class="text-2xl font-bold text-center mb-6">My Shopping Cart</h2>
        
        <!-- Product List -->
        <div class="space-y-4">
             @foreach (session('cart', []) as $productId => $item)
            <div class="flex items-center border-b pb-4">
                @php
                    $productImage = DB::table('productimage')
                        ->where('product_id', $item['product_id'])
                        ->first();
                    $imagePath = $productImage ? 'assets/images/product/' . $productImage->thumbnail : 'assets/images/product/default-thumbnail.jpg';
                @endphp
                <img src="{{ asset($imagePath) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                <div class="ml-4 flex-1">
                    <h3 class="font-semibold">{{ $item['name'] }}</h3>
                    <p class="text-sm text-gray-500">Product Code: {{ $item['product_id'] }}</p>
                </div>
                <span class="ml-6 font-semibold">{{ number_format($item['price'], 0, ',', '.') }}₫</span>
                <span class="ml-2">x {{ $item['quantity'] }}</span>
                <form action="{{ route('cart.removeFromCart') }}" method="POST" class="ml-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $productId }}">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded flex items-center" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                        <i class="fa fa-trash mr-1"></i> Xóa
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        
        <!-- Summary -->
        <div class="mt-6 border-t pt-4">
            <div class="flex justify-between text-lg font-semibold">
                <span>Subtotal:</span>
                <span>{{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, session('cart', []))), 0, ',', '.') }}₫</span>
            </div>
            <div class="flex justify-between text-sm text-gray-500 mt-2">
                <span>Discount:</span>
                <span>£0.00</span>
            </div>
            <div class="flex justify-between text-sm text-gray-500 mt-2">
                <span>Delivery:</span>
                <span>£0.00</span>
            </div>
            <div class="flex justify-between text-lg font-bold mt-4">
                <span>Total:</span>
                <span>{{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, session('cart', []))), 0, ',', '.') }}₫</span>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="mt-6">
            <input type="text" placeholder="Enter promo code" class="w-full border rounded px-4 py-2 mb-2">
            <button class="w-full bg-blue-600 text-white rounded py-2 hover:bg-blue-700">Apply Discount</button>
        </div>
        <div class="mt-4 flex space-x-2">
            <a href="{{ route('site.product') }}" class="flex-1 bg-gray-300 text-black rounded py-2 hover:bg-gray-400 text-center">Continue Shopping</a>
            <button class="flex-1 bg-blue-600 text-white rounded py-2 hover:bg-blue-700">Checkout</button>
        </div>
        <div class="mt-6">
            <div class="flex justify-between items-center">
                <span class="text-lg font-semibold">Tổng tiền:</span>
                <span class="text-xl font-bold">{{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, session('cart', []))), 0, ',', '.') }}₫</span>
            </div>
            <div class="mt-6">
                <a href="{{ route('checkout.index') }}" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-300 block text-center">
                    Thanh toán
                </a>
            </div>
        </div>
    </div>
</main>
</x-layout-site>