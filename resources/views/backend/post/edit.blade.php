<x-layout-admin>
    <form action="{{ route('post.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Cập nhật bài viết</h2>
                    <div class="flex space-x-2">
                        <button type="submit"
                            class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save mr-1" aria-hidden="true"></i> Lưu
                        </button>
                        <a href="{{ route('post.index') }}"
                            class="flex items-center bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-arrow-left mr-1"></i> Về danh sách
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Cột trái --}}
                    <div>
                        {{-- Tiêu đề --}}
                        <div class="mb-4">
                            <label for="title" class="font-semibold">Tiêu đề</label>
                            <input value="{{ old('title', $post->title) }}" type="text" name="title" id="title"
                                class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập tiêu đề bài viết">
                            @error('title')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="mb-4">
                            <label for="slug" class="font-semibold">Slug</label>
                            <input value="{{ old('slug', $post->slug) }}" type="text" name="slug" id="slug"
                                class="w-full border border-gray-300 rounded-lg p-2" placeholder="Tự động hoặc nhập slug">
                            @error('slug')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nội dung chi tiết --}}
                        <div class="mb-4">
                            <label for="detail" class="font-semibold">Chi tiết bài viết</label>
                            <textarea name="detail" id="detail" rows="5"
                                class="w-full border border-gray-300 rounded-lg p-2"
                                placeholder="Nhập chi tiết bài viết">{{ old('detail', $post->detail) }}</textarea>
                            @error('detail')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Cột phải --}}
                    <div>
                        {{-- Hình thumbnail --}}
                        <div class="mb-4">
                            <label for="thumbnail"><strong>Thumbnail</strong></label>
                            <input type="file" name="thumbnail" id="thumbnail" class="w-full border border-gray-300 rounded-lg p-2" accept="image/*">
                            @if($post->thumbnail)
                                <div class="mt-2">
                                    <img src="{{ asset($post->thumbnail) }}" alt="Thumbnail" class="w-32 h-auto rounded">
                                </div>
                            @endif
                            @error('thumbnail') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        {{-- Trạng thái --}}
                        <div class="mb-4">
                            <label for="status" class="font-semibold">Trạng thái</label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1" {{ old('status', $post->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', $post->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                            @error('status')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Loại bài viết --}}
                        <div class="mb-4">
                            <label for="type" class="font-semibold">Loại bài viết</label>
                            <input value="{{ old('type', $post->type) }}" type="text" name="type" id="type"
                                class="w-full border border-gray-300 rounded-lg p-2" placeholder="Ví dụ: bài viết, tin tức...">
                            @error('type')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Người tạo --}}
                        <div class="mb-4">
                            <label for="created_by" class="font-semibold">Người tạo</label>
                            <input value="{{ old('created_by', $post->created_by) }}" type="text" id="created_by"
                                class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
