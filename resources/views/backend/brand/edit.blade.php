<x-layout-admin>
    <form action="{{ route('brand.update', ['brand' => $brand->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Cập nhật thương hiệu</h2>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save mr-1" aria-hidden="true"></i> Lưu
                        </button>
                        <a href="{{ route('brand.index') }}"
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
                        {{-- Tên brand --}}
                        <div class="mb-4">
                            <label for="name" class="font-semibold">Tên thương hiệu</label>
                            <input value="{{ old('name', $brand->name) }}" type="text" name="name" id="name"
                                   class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập tên thương hiệu">
                            @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="mb-4">
                            <label for="slug" class="font-semibold">Slug</label>
                            <input value="{{ old('slug', $brand->slug) }}" type="text" name="slug" id="slug"
                                   class="w-full border border-gray-300 rounded-lg p-2" placeholder="Tự động hoặc nhập slug">
                            @error('slug')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mô tả --}}
                        <div class="mb-4">
                            <label for="description" class="font-semibold">Mô tả</label>
                            <textarea name="description" id="description" rows="4"
                                      class="w-full border border-gray-300 rounded-lg p-2"
                                      placeholder="Nhập mô tả thương hiệu">{{ old('description', $brand->description) }}</textarea>
                            @error('description')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Cột phải --}}
                    <div>
                        {{-- Hình ảnh --}}
                        <div class="mb-4">
                            <label for="image" class="font-semibold">Hình ảnh</label>
                            <input type="file" name="image" id="image"
                                   class="w-full border border-gray-300 rounded-lg p-2">
                            @error('image')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            @if($brand->image)
                                <div class="mt-2">
                                    <img src="{{ asset('assets/images/brand/' . $brand->image) }}" alt="Hình ảnh"
                                         class="w-32 h-auto rounded">
                                </div>
                            @endif
                        </div>

                        {{-- Trạng thái --}}
                        <div class="mb-4">
                            <label for="status" class="font-semibold">Trạng thái</label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1" {{ old('status', $brand->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', $brand->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                            @error('status')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Vị trí hiển thị (sort_order) --}}
                        <div class="mb-4">
                            <label for="sort_order" class="font-semibold">Thứ tự hiển thị</label>
                            <input value="{{ old('sort_order', $brand->sort_order) }}" type="number" name="sort_order" id="sort_order"
                                   class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập số thứ tự hiển thị">
                            @error('sort_order')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Người tạo (created_by) --}}
                        <div class="mb-4">
                            <label for="created_by" class="font-semibold">Người tạo</label>
                            <input value="{{ old('created_by', $brand->created_by) }}" type="text" name="created_by" id="created_by"
                                   class="w-full border border-gray-300 rounded-lg p-2" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
