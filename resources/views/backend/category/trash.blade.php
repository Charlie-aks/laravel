<x-layout-admin>
    <div class="content-wrapper bg-white">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-red-400">Thùng rác thương hiệu</h2>
                <a href="{{ route('category.index') }}" class="bg-blue-400 text-white px-4 py-2 rounded-lg">
                    Quay lại danh sách
                </a>
            </div>
        </div>

        <div class="border border-blue-100 rounded-lg p-2">
            <table class="w-full border-collapse border border-gray-400">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2">Hình ảnh</th>
                        <th class="border border-gray-300 p-2">Tên thương hiệu</th>
                        <th class="border border-gray-300 p-2">Mô tả</th>
                        <th class="border border-gray-300 p-2">Thứ tự</th>
                        <th class="border border-gray-300 p-2">Trạng thái</th>
                        <th class="border border-gray-300 p-2">Ngày xóa</th>
                        <th class="border border-gray-300 p-2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $item)
                        <tr>
                            <td class="border border-gray-300 p-2 text-center">
                                @if($item->image)
                                    <img src="{{ asset('assets/images/category/' . $item->image) }}" class="w-16 h-16 object-cover rounded-md mx-auto" alt="Hình ảnh">
                                @else
                                    <span class="text-gray-400 italic">Không có ảnh</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 p-2">{{ Str::limit($item->description, 50) }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $item->sort_order }}</td>
                            <td class="border border-gray-300 p-2 text-center">
                                @if ($item->status == 1)
                                    <span class="text-green-600 font-semibold">Hiển thị</span>
                                @else
                                    <span class="text-gray-500">Ẩn</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 p-2 text-center">
                                {{ \Carbon\Carbon::parse($item->deleted_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="border border-gray-300 p-2 text-center space-y-2">
                                <!-- Khôi phục -->
                                <form action="{{ route('category.restore', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-green-600 hover:underline">
                                        <i class="fa fa-undo"></i> Khôi phục
                                    </button>
                                </form>

                                <!-- Xóa vĩnh viễn -->
                                <form action="{{ route('category.destroy', ['category' => $item->id]) }}" method="POST" class="inline-block mt-1"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa vĩnh viễn thương hiệu này không?')">
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
                            <td colspan="7" class="text-center text-gray-500 py-6 italic">
                                Không có thương hiệu nào trong thùng rác.
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
