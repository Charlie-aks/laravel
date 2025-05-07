<x-layout-admin>
    <form action="{{ route('post.store') }}" method="POST">
        @csrf
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Thêm Bài viết</h2>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save mr-2" aria-hidden="true"></i> Lưu
                        </button>
                        <a href="{{ route('post.index') }}" class="flex items-center bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-arrow-left mr-2"></i> Thoát
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-4 space-y-4">

                <div>
                    <label for="topic_id"><strong>Chủ đề</strong></label>
                    <input type="number" name="topic_id" id="topic_id" value="{{ old('topic_id') }}" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập ID chủ đề">
                    @error('topic_id') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="title"><strong>Tiêu đề</strong></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập tiêu đề bài viết">
                    @error('title') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="slug"><strong>Slug</strong></label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Slug (nếu để trống sẽ tạo từ tiêu đề)">
                    @error('slug') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="detail"><strong>Nội dung chi tiết</strong></label>
                    <textarea name="detail" id="detail" class="w-full border border-gray-300 rounded-lg p-2" rows="5" placeholder="Nhập nội dung chi tiết">{{ old('detail') }}</textarea>
                    @error('detail') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="thumbnail"><strong>Thumbnail</strong></label>
                    <input type="text" name="thumbnail" id="thumbnail" value="{{ old('thumbnail') }}" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Đường dẫn ảnh thumbnail">
                    @error('thumbnail') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="type"><strong>Loại bài viết</strong></label>
                    <input type="text" name="type" id="type" value="{{ old('type') }}" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Ví dụ: post, page, etc.">
                    @error('type') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="description"><strong>Mô tả</strong></label>
                    <textarea name="description" id="description" class="w-full border border-gray-300 rounded-lg p-2" rows="3" placeholder="Nhập mô tả ngắn">{{ old('description') }}</textarea>
                    @error('description') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="status"><strong>Trạng thái</strong></label>
                    <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Xuất bản</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Không xuất bản</option>
                    </select>
                    @error('status') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

            </div>
        </div>
    </form>
</x-layout-admin>
