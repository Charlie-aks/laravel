<x-layout-admin>
    <form action="{{ route('topic.store') }}" method="POST">
        @csrf
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Thêm Chủ đề</h2>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save mr-2" aria-hidden="true"></i> Lưu
                        </button>
                        <a href="{{ route('topic.index') }}" class="flex items-center bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-arrow-left mr-2"></i> Thoát
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-4">
                <!-- Tên chủ đề -->
                <div class="mb-3">
                    <label for="name"><strong>Tên chủ đề</strong></label>
                    <input value="{{ old('name') }}" type="text" name="name" id="name" placeholder="Nhập tên chủ đề" class="w-full border border-gray-300 rounded-lg p-2">
                    @error('name') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label for="slug"><strong>Slug</strong></label>
                    <input value="{{ old('slug') }}" type="text" name="slug" id="slug" placeholder="nhap-slug-khong-dau" class="w-full border border-gray-300 rounded-lg p-2">
                    @error('slug') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <!-- Mô tả -->
                <div class="mb-3">
                    <label for="description"><strong>Mô tả</strong></label>
                    <textarea name="description" id="description" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                    @error('description') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <!-- Trạng thái -->
                <div class="mb-3">
                    <label for="status"><strong>Trạng thái</strong></label>
                    <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tạm ẩn</option>
                    </select>
                    @error('status') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <!-- Hidden created_by và updated_by -->
                <input type="hidden" name="created_by" value="1">
                <input type="hidden" name="updated_by" value="1">
            </div>
        </div>
    </form>
</x-layout-admin>
