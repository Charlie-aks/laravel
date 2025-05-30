<x-layout-admin>
    <div class="content-wrapper bg-white">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <div class="">
                    <h2 class="text-xl font-bold text-blue-300">Đánh giá của khách hàng</h2>
                </div>
                <div class="text-right">
                    <a href="{{route('feedback.create')}}" class="bg-green-300 px-2 py-2 rounded-xl mx-1 text-white">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Thêm mới
                    </a>
                    <a href="{{route('feedback.trash')}}" class="bg-red-300 px-2 py-2 rounded-xl mx-1 text-white">
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
                        <th class="border border-gray-300 p-2">Số sao</th>
                        <th class="border border-gray-300 p-2">Bình luận</th>
                        <th class="border border-gray-300 p-2">ID</th>
                        <th class="border border-gray-300 p-2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                    <tr>  
                        <td class="border border-gray-300 p-2">{{ $item->star }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->content }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->id }}</td>
                        <td class="border border-gray-300 p-2 text-center space-x-2">
                            <a href="{{ route('feedback.status', ['feedback' => $item->id]) }}" class="inline-block">
                                @if ($item->status == 1)
                                    <i class="fa fa-toggle-on text-2xl text-green-400" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-toggle-off text-2xl text-red-400" aria-hidden="true"></i>
                                @endif
                            </a>
                            <a href="{{ route('feedback.edit', ['feedback' => $item->id]) }}" class="inline-block">
                                <i class="fa fa-edit text-2xl text-blue-400" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('feedback.delete', ['feedback' => $item->id]) }}" 
                               class="inline-block"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                <i class="fa fa-trash text-2xl text-red-400" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">{{ $list->links() }}</div>
        </div>
    </div>
</x-layout-admin>