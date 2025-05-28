<x-layout-admin>
    <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-black-600">Danh sách bài viết</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('post.create') }}"
                        class="flex items-center bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-white shadow-md">
                        <i class="fa fa-plus"></i> Thêm mới
                    </a>
                    <a href="{{ route('post.trash') }}"
                        class="flex items-center bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-white shadow-md">
                        <i class="fa fa-trash"></i> Thùng rác
                    </a>
                </div>
            </div>
        </div>

        <!-- Form tìm kiếm -->
        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <form action="{{ route('post.search') }}" method="GET" class="flex gap-4">
                <div class="flex-1">
                    <input type="text" 
                           name="keyword" 
                           value="{{ $keyword ?? '' }}"
                           placeholder="Tìm kiếm theo tiêu đề, nội dung, mô tả..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 px-6 py-2 rounded-lg text-white shadow-md">
                    <i class="fa fa-search"></i> Tìm kiếm
                </button>
            </form>
        </div>

        <div class="border border-blue-100 rounded-lg p-2">
            <table class="border-collapse border-gray-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2">ID</th>
                        <th class="border border-gray-300 p-2">Hình ảnh</th>
                        <th class="border border-gray-300 p-2">Tiêu đề</th>
                        <th class="border border-gray-300 p-2">Loại</th>
                        <th class="border border-gray-300 p-2">Mô tả</th>
                        <th class="border border-gray-300 p-2">Trạng thái</th>
                        <th class="border border-gray-300 p-2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                    <tr>  
                        <td class="border border-gray-300 p-2 text-center">{{ $item->id }}</td>
                        <td class="border border-gray-300 p-2 text-center">
                            @if($item->thumbnail)
                                <img src="{{ asset($item->thumbnail) }}" class="w-20 h-20 object-cover mx-auto">
                            @else
                                <span class="text-gray-400">Không có ảnh</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 p-2">
                            <div class="font-semibold">{{ $item->title }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($item->detail, 100) }}</div>
                        </td>
                        <td class="border border-gray-300 p-2 text-center">{{ $item->type }}</td>
                        <td class="border border-gray-300 p-2">{{ Str::limit($item->description, 100) }}</td>
                        <td class="border border-gray-300 p-2 text-center">
                            @if ($item->status == 1)
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">Xuất bản</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-sm">Ẩn</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 p-2 text-center space-x-2">
                            <a href="{{ route('post.status', ['post' => $item->id]) }}" class="inline-block">
                                @if ($item->status == 1)
                                    <i class="fa fa-toggle-on text-2xl text-green-400" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-toggle-off text-2xl text-red-400" aria-hidden="true"></i>
                                @endif
                            </a>
                            <a href="{{ route('post.edit', ['post' => $item->id]) }}" class="inline-block">
                                <i class="fa fa-edit text-2xl text-blue-400" aria-hidden="true"></i>
                            </a>
                            <form action="{{ route('post.delete', ['post' => $item->id]) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                    <i class="fa fa-trash text-2xl" aria-hidden="true"></i>
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