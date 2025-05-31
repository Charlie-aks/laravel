<x-layout-admin>
    <div class="content-wrapper bg-white">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-red-400">Thùng rác giá khuyến mãi</h2>
                <a href="{{ route('productsale.index') }}" class="bg-blue-400 text-white px-4 py-2 rounded-lg">
                    Quay lại danh sách
                </a>
            </div>
        </div>

        <div class="border border-blue-100 rounded-lg p-2">
            <table class="w-full border-collapse border border-gray-400">
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
                    @forelse ($productsales as $item)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $item->product->name ?? 'Sản phẩm đã bị xóa' }}</td>
                            <td class="border border-gray-300 p-2">{{ number_format($item->price_sale, 0, ',', '.') }}₫</td>
                            <td class="border border-gray-300 p-2">{{ date('d/m/Y', strtotime($item->date_begin)) }}</td>
                            <td class="border border-gray-300 p-2">{{ date('d/m/Y', strtotime($item->date_end)) }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->user->name ?? 'N/A' }}</td>
                            <td class="border border-gray-300 p-2 text-center space-y-2">
                                <a href="{{ route('productsale.restore', ['productsale' => $item->id]) }}"
                                    class="inline-block text-green-600 hover:underline">
                                    <i class="fa fa-undo"></i> Khôi phục
                                </a>

                                <form action="{{ route('productsale.destroy', ['productsale' => $item->id]) }}"
                                    method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa vĩnh viễn giá khuyến mãi này không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">
                                        <i class="fa fa-trash"></i> Xóa vĩnh viễn
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-6 italic">
                                Không có giá khuyến mãi nào trong thùng rác.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $productsales->links() }}
            </div>
        </div>
    </div>
</x-layout-admin> 