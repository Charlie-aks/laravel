<x-layout-admin>
    <div class="content-wrapper bg-white">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-red-400">Thùng rác banner</h2>
                <a href="{{ route('banner.index') }}" class="bg-blue-400 text-white px-4 py-2 rounded-lg">
                    Quay lại danh sách
                </a>
            </div>
        </div>

        <div class="border border-blue-100 rounded-lg p-2">
            <table class="w-full border-collapse border border-gray-400">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2">Hình ảnh</th>
                        <th class="border border-gray-300 p-2">Tên banner</th>
                        <th class="border border-gray-300 p-2">Trạng thái</th>
                        <th class="border border-gray-300 p-2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                    <tr>
                        <td class="border border-gray-300 p-2">
                            <img src="{{ asset($item->image) }}" class="w-16 h-16 object-cover" alt="">
                        </td>
                        <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                        <td class="border border-gray-300 p-2">
                            @if ($item->status == 1)
                                <span class="text-green-500 font-semibold">Hiển thị</span>
                            @else
                                <span class="text-gray-500">Ẩn</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 p-2 text-center space-x-2">
                            <!-- Restore -->
                            <a href="{{ route('banner.restore', ['banner' => $item->id]) }}" class="inline-block text-green-500">
                                <i class="fa fa-undo" aria-hidden="true"></i> Khôi phục
                            </a>

                            <!-- Permanent Delete -->
                            <form action="{{ route('banner.destroy', ['banner' => $item->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa vĩnh viễn banner này không?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">
                                    <i class="fa fa-times" aria-hidden="true"></i> Xóa vĩnh viễn
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">{{ $list->links() }}</div>
        </div>
    </div>
</x-layout-admin>
