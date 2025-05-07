<x-layout-admin>
    <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Thêm thương hiệu</h2>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save" aria-hidden="true"></i> Lưu
                        </button>
                        <a href="{{ route('brand.index') }}" class="flex items-center bg-blue-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-arrow-left"></i> Thoát
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex gap-6">
                    <div class="basis-9/12">
                        <!-- Tên thương hiệu -->
                        <div class="mb-3">
                            <label for="name"><strong>Tên thương hiệu</strong></label>
                            <input value="{{ old('name') }}" type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập tên thương hiệu" name="name" id="name">
                            @error('name') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <label for="slug"><strong>Slug</strong></label>
                            <input value="{{ old('slug') }}" type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập slug (tự tạo nếu bỏ trống)" name="slug" id="slug">
                            @error('slug') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label for="description"><strong>Mô tả thương hiệu</strong></label>
                            <textarea name="description" id="description" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                            @error('description') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <!-- Thứ tự sắp xếp -->
                        <div class="mb-3">
                            <label for="sort_order"><strong>Thứ tự hiển thị</strong></label>
                            <input value="{{ old('sort_order', 0) }}" type="number" class="w-full border border-gray-300 rounded-lg p-2" placeholder="VD: 1, 2, 3..." name="sort_order" id="sort_order">
                            @error('sort_order') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="basis-3/12">
                        <!-- Hình ảnh -->
                        <div class="mb-3">
                            <label for="image"><strong>Hình ảnh</strong></label>
                            <input type="file" class="w-full border border-gray-300 rounded-lg p-2" name="image" id="image">
                            @error('image') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status"><strong>Trạng thái</strong></label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Xuất bản</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Không xuất bản</option>
                            </select>
                            @error('status') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
