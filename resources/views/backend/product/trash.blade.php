<x-layout-admin>
    <div class="content-wrapper bg-white">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-red-400">Thùng rác sản phẩm</h2>
                <a href="{{ route('product.index') }}" class="bg-blue-400 text-white px-4 py-2 rounded-lg">
                    Quay lại danh sách
                </a>
            </div>
        </div>

        <div class="border border-blue-100 rounded-lg p-2">
            <table class="w-full border-collapse border border-gray-400">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2">Hình ảnh</th>
                        <th class="border border-gray-300 p-2">Tên sản phẩm</th>
                        <th class="border border-gray-300 p-2">Danh mục</th>
                        <th class="border border-gray-300 p-2">Thương hiệu</th>
                        <th class="border border-gray-300 p-2">Giá gốc</th>
                        <th class="border border-gray-300 p-2">Giá khuyến mãi</th>
                        <th class="border border-gray-300 p-2">Số lượng</th>
                        <th class="border border-gray-300 p-2">Trạng thái</th>
                        <th class="border border-gray-300 p-2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $item)
                        <tr>
                            <td class="border border-gray-300 p-2 text-center">
                                <div class="flex flex-wrap gap-1 justify-center">
                                    @foreach($item->productimage as $image)
                                        <img src="{{ asset('assets/images/product/' . $image->thumbnail) }}" 
                                             class="w-20 h-20 object-cover rounded-md" 
                                             alt="Ảnh sản phẩm">
                                    @endforeach
                                </div>
                            </td>
                            <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->categoryname }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->brandname }}</td>
                            <td class="border border-gray-300 p-2">{{ number_format($item->price_root, 0, ',', '.') }}₫</td>
                            <td class="border border-gray-300 p-2">
                                @if ($item->price_sale)
                                    <span class="text-red-500">{{ number_format($item->price_sale, 0, ',', '.') }}₫</span>
                                @else
                                    <span class="text-gray-400 italic">Không có</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 p-2 text-center">{{ $item->qty ?? '0' }}</td>
                            <td class="border border-gray-300 p-2 text-center">
                                @if ($item->status == 1)
                                    <span class="text-green-600 font-semibold">Hiện</span>
                                @else
                                    <span class="text-gray-500">Ẩn</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 p-2 text-center space-y-2">
                                <a href="{{ route('product.restore', ['product' => $item->id]) }}"
                                    class="inline-block text-green-600 hover:underline">
                                    <i class="fa fa-undo"></i> Khôi phục
                                </a>

                                <form action="{{ route('product.destroy', ['product' => $item->id]) }}"
                                    method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa vĩnh viễn sản phẩm này không?')">
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
                            <td colspan="9" class="text-center text-gray-500 py-6 italic">
                                Không có sản phẩm nào trong thùng rác.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $list->links() }}
            </div>
        </div>
    </div>
</x-layout-admin>
