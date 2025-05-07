<x-layout-admin>
    <x-slot:title>Chi tiết đơn hàng #{{ $order->id }}</x-slot:title>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Chi tiết đơn hàng #{{ $order->id }}</h1>
            <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Quay lại</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Thông tin đơn hàng -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Thông tin đơn hàng</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Trạng thái</label>
                        <div class="mt-1">
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center space-x-4">
                                @csrf
                                <select name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Chờ xác nhận</option>
                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đã xác nhận</option>
                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đã giao hàng</option>
                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ngày đặt</label>
                        <div class="mt-1">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tổng tiền</label>
                        <div class="mt-1 font-semibold">{{ number_format($order->total, 0, ',', '.') }}₫</div>
                    </div>
                </div>
            </div>

            <!-- Thông tin khách hàng -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Thông tin khách hàng</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Họ tên</label>
                        <div class="mt-1">{{ $order->name }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                        <div class="mt-1">{{ $order->phone }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1">{{ $order->email }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Địa chỉ</label>
                        <div class="mt-1">{{ $order->address }}</div>
                    </div>
                    @if($order->note)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ghi chú</label>
                            <div class="mt-1">{{ $order->note }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Chi tiết sản phẩm -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Chi tiết sản phẩm</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Đơn giá</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->orderDetails as $detail)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('assets/images/product/' . $detail->product->thumbnail) }}" alt="{{ $detail->product->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $detail->product->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ number_format($detail->price_buy, 0, ',', '.') }}₫</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $detail->qty }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ number_format($detail->amount, 0, ',', '.') }}₫</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-admin> 