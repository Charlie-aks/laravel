<x-layout-admin>
    <div class="content-wrapper bg-white">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <div class="">
                    <h2 class="text-xl font-bold text-blue-300">Danh sách giá khuyến mãi</h2>
                </div>
                <div class="text-right">
                    <a href="{{ route('productsale.create') }}" class="bg-green-300 px-2 py-2 rounded-xl mx-1 text-white">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Thêm mới
                    </a>
                    <a href="{{ route('productsale.trash') }}" class="bg-red-300 px-2 py-2 rounded-xl mx-1 text-white">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        Thùng rác
                    </a>
                </div>
            </div>
        </div>
        <div class="border border-blue-100 rounded-lg p-2">
            <table class="border-collapse border-gray-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2">Sản phẩm</th>
                        <th class="border border-gray-300 p-2">Giá khuyến mãi</th>
                        <th class="border border-gray-300 p-2">Ngày bắt đầu</th>
                        <th class="border border-gray-300 p-2">Ngày kết thúc</th>
                        <th class="border border-gray-300 p-2">Người tạo</th>
                        <th class="border border-gray-300 p-2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsales as $item)
                    <tr>  
                        <td class="border border-gray-300 p-2">{{ $item->product->name ?? 'Sản phẩm đã bị xóa' }}</td>
                        <td class="border border-gray-300 p-2">{{ number_format($item->price_sale, 0, ',', '.') }}₫</td>
                        <td class="border border-gray-300 p-2">{{ date('d/m/Y', strtotime($item->date_begin)) }}</td>
                        <td class="border border-gray-300 p-2">{{ date('d/m/Y', strtotime($item->date_end)) }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->user->name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 p-2 text-center space-x-2">
                            <a href="{{ route('productsale.edit', ['productsale' => $item->id]) }}" class="inline-block">
                                <i class="fa fa-edit text-2xl text-blue-400" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('productsale.delete', ['productsale' => $item->id]) }}" 
                               class="inline-block"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa giá khuyến mãi này?')">
                                <i class="fa fa-trash text-2xl text-red-400" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Phân trang -->
            <div class="mt-4">{{ $productsales->links() }}</div>
        </div>
    </div>
</x-layout-admin> 