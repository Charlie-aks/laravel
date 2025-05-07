<x-layout-site>
    <x-slot:title>Thanh toán</x-slot:title>
    <main class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto px-4">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            <div class="max-w-4xl mx-auto">
                <h1 class="text-2xl font-bold mb-6">Thanh toán</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Thông tin thanh toán -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold mb-4">Thông tin thanh toán</h2>
                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    Họ và tên <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                                    Số điện thoại <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="phone" id="phone" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                                    Địa chỉ <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="address" id="address" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="note">
                                    Ghi chú
                                </label>
                                <textarea name="note" id="note" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Phương thức thanh toán
                                </label>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="cod" id="cod" class="mr-2" checked>
                                        <label for="cod">Thanh toán khi nhận hàng (COD)</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="vnpay" id="vnpay" class="mr-2">
                                        <label for="vnpay">Thanh toán qua VNPay</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                                    Đặt hàng
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Đơn hàng -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold mb-4">Đơn hàng của bạn</h2>
                        <div class="space-y-4">
                            @foreach ($cart as $productId => $item)
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
                                    <p class="text-sm text-gray-500">Số lượng: {{ $item['quantity'] }}</p>
                                </div>
                                <span class="font-semibold">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}₫</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-6 border-t pt-4">
                            <div class="flex justify-between text-lg font-semibold">
                                <span>Tổng tiền:</span>
                                <span>{{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart)), 0, ',', '.') }}₫</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout-site> 