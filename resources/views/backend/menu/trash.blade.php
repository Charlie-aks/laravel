<x-layout-admin>
    <div class="content-wrapper bg-white">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-red-400">Thùng rác menu</h2>
                <a href="{{ route('menu.index') }}" class="bg-blue-400 text-white px-4 py-2 rounded-lg">
                    Quay lại danh sách
                </a>
            </div>
        </div>

        <div class="border border-blue-100 rounded-lg p-2">
            <table class="w-full border-collapse border border-gray-400">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2">Tên menu</th>
                        <th class="border border-gray-300 p-2">Link</th>
                        <th class="border border-gray-300 p-2">Loại</th>
                        <th class="border border-gray-300 p-2">Vị trí</th>
                        <th class="border border-gray-300 p-2">Trạng thái</th>
                        <th class="border border-gray-300 p-2">Ngày xóa</th>
                        <th class="border border-gray-300 p-2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $item)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->link }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->type }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->position }}</td>
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
                                <!-- Restore -->
                                <a href="{{ route('menu.restore', ['menu' => $item->id]) }}" class="inline-block text-green-600 hover:underline">
                                    <i class="fa fa-undo"></i> Khôi phục
                                </a>

                                <!-- Permanent Delete -->
                                <form action="{{ route('menu.destroy', ['menu' => $item->id]) }}" method="POST"
                                    class="inline-block mt-1"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa vĩnh viễn menu này không?')">
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
                                Không có menu nào trong thùng rác.
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
