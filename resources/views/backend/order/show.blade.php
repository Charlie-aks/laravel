<x-layout-admin>
    <x-slot:title>Chi tiết đơn hàng #{{ $order->id }}</x-slot:title>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Chi tiết đơn hàng #{{ $order->id }}</h2>
                <div class="space-x-2">
                    <a href="{{ route('order.edit', $order->id) }}" 
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                        <i class="fas fa-edit mr-2"></i>Sửa
                    </a>
                    <a href="{{ route('order.index') }}" 
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        <i class="fas fa-arrow-left mr-2"></i>Quay lại
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Thông tin khách hàng</h3>
                    <div class="space-y-2">
                        <p><span class="font-medium">Tên:</span> {{ $order->name }}</p>
                        <p><span class="font-medium">Email:</span> {{ $order->email }}</p>
                        <p><span class="font-medium">Số điện thoại:</span> {{ $order->phone }}</p>
                        <p><span class="font-medium">Địa chỉ:</span> {{ $order->address }}</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Thông tin đơn hàng</h3>
                    <div class="space-y-2">
                        <p>
                            <span class="font-medium">Trạng thái:</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($order->status == 'completed') bg-green-100 text-green-800
                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                @if($order->status == 'pending') Chờ xử lý
                                @elseif($order->status == 'processing') Đang xử lý
                                @elseif($order->status == 'completed') Hoàn thành
                                @elseif($order->status == 'cancelled') Đã hủy
                                @endif
                            </span>
                        </p>
                        <p><span class="font-medium">Ngày đặt:</span> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p><span class="font-medium">Ghi chú:</span> {{ $order->note ?? 'Không có' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Chi tiết sản phẩm</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sản phẩm</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Size</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Đơn giá</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Số lượng</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($order->orderDetails as $detail)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $detail->product->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $detail->size ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($detail->price_buy, 0, ',', '.') }}₫
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $detail->qty }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($detail->amount, 0, ',', '.') }}₫
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right font-medium">Tổng tiền:</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ number_format($order->total) }}₫
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout-admin> 