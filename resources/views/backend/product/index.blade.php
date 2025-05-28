<x-layout-admin>
    <div class="content-wrapper bg-white">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <div class="">
                    <h2 class="text-xl font-bold text-blue-300">Danh sách sản phẩm</h2>
                </div>
                <div class="text-right">
                    <a href="{{ route('product.create') }}" class="bg-green-300 px-2 py-2 rounded-xl mx-1 text-white">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Thêm mới
                    </a>
                    <a href="{{ route('product.trash') }}" class="bg-red-300 px-2 py-2 rounded-xl mx-1 text-white">
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
                        <th class="border border-gray-300 p-2">Hình ảnh</th>
                        <th class="border border-gray-300 p-2">Tên sản phẩm</th>
                        <th class="border border-gray-300 p-2">Danh mục</th>
                        <th class="border border-gray-300 p-2">Thương hiệu</th>
                        <th class="border border-gray-300 p-2">ID</th>
                        <th class="border border-gray-300 p-2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                    <tr>  
                        <td class="border border-gray-300 p-2">
                            <!-- Hiển thị hình ảnh -->
                            <div class="flex flex-wrap gap-1">
                                @foreach($item->productimage as $image)
                                    <img src="{{ asset('assets/images/product/' . $image->thumbnail) }}" 
                                         class="w-16 h-16 object-cover rounded" 
                                         alt="{{ $item->name }}">
                                @endforeach
                            </div>
                        </td>
                        <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->categoryname }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->brandname }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->id }}</td>
                        <td class="border border-gray-300 p-2 text-center space-x-2">
                            <a href="{{ route('product.status', ['product' => $item->id]) }}" class="inline-block">
                                @if ($item->status == 1)
                                    <i class="fa fa-toggle-on text-2xl text-green-400" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-toggle-off text-2xl text-red-400" aria-hidden="true"></i>
                                @endif
                            </a>
                            <a href="{{ route('product.edit', ['product' => $item->id]) }}" class="inline-block">
                                <i class="fa fa-edit text-2xl text-blue-400" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('product.delete', ['product' => $item->id]) }}" 
                               class="inline-block"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                <i class="fa fa-trash text-2xl text-red-400" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Phân trang -->
            <div class="mt-4">{{ $list->links() }}</div>
        </div>
    </div>
</x-layout-admin>
