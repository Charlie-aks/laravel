<x-layout-admin>
    <div class="content-wrapper bg-white">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-red-400">Thùng rác liên hệ</h2>
                <a href="{{ route('contact.index') }}" class="bg-blue-400 text-white px-4 py-2 rounded-lg">
                    Quay lại danh sách
                </a>
            </div>
        </div>

        <div class="border border-blue-100 rounded-lg p-2">
            <table class="w-full border-collapse border border-gray-400">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2">Tên</th>
                        <th class="border border-gray-300 p-2">Email</th>
                        <th class="border border-gray-300 p-2">Số điện thoại</th>
                        <th class="border border-gray-300 p-2">Tiêu đề</th>
                        <th class="border border-gray-300 p-2">Trạng thái</th>
                        <th class="border border-gray-300 p-2">Ngày xóa</th>
                        <th class="border border-gray-300 p-2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $item)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->email }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->phone }}</td>
                            <td class="border border-gray-300 p-2">{{ Str::limit($item->title, 50) }}</td>
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
                                <a href="{{ route('contact.restore', ['contact' => $item->id]) }}" class="inline-block text-green-600 hover:underline">
                                    <i class="fa fa-undo"></i> Khôi phục
                                </a>

                                <!-- Permanent Delete -->
                                <form action="{{ route('contact.destroy', ['contact' => $item->id]) }}" method="POST"
                                    class="inline-block mt-1"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa vĩnh viễn liên hệ này không?')">
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
                                Không có liên hệ nào trong thùng rác.
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
