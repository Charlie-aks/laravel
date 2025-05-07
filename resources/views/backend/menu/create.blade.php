<x-layout-admin>
    <form action="{{ route('menu.store') }}" method="post">
        @csrf
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Thêm Menu</h2>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save"></i> Lưu
                        </button>
                        <a href="{{ route('menu.index') }}" class="flex items-center bg-blue-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-arrow-left"></i> Thoát
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex gap-6">
                    <div class="basis-9/12">
                        <div class="mb-3">
                            <label for="name"><strong>Tên menu</strong></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập tên menu">
                            @error('name') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="link"><strong>Liên kết</strong></label>
                            <input type="text" name="link" id="link" value="{{ old('link') }}"
                                class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập đường dẫn (URL)">
                            @error('link') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type"><strong>Loại</strong></label>
                            <select name="type" id="type"
                            class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="category" {{ old('type') == 'category' ? 'selected' : '' }}>Danh mục</option>
                                <option value="brand" {{ old('type') == 'brand' ? 'selected' : '' }}>Thương hiệu</option>
                                <option value="page" {{ old('type') == 'page' ? 'selected' : '' }}>Trang</option>
                                <option value="topic" {{ old('type') == 'topic' ? 'selected' : '' }}>Chủ đề</option>
                                <option value="custom" {{ old('type') == 'custom' ? 'selected' : '' }}>Tùy chỉnh</option>
                            </select>
                            @error('type') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="position"><strong>Vị trí</strong></label>
                            <input type="text" name="position" id="position" value="{{ old('position') }}"
                                class="w-full border border-gray-300 rounded-lg p-2" placeholder="VD: top, bottom">
                            @error('position') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="basis-3/12">
                        <div class="mb-3">
                            <label for="sort_order"><strong>Thứ tự hiển thị</strong></label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                                class="w-full border border-gray-300 rounded-lg p-2">
                            @error('sort_order') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="parent_id"><strong>Menu cha</strong></label>
                            <input type="number" name="parent_id" id="parent_id" value="{{ old('parent_id', 0) }}"
                                class="w-full border border-gray-300 rounded-lg p-2">
                            @error('parent_id') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status"><strong>Trạng thái</strong></label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Xuất bản</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Không xuất bản</option>
                            </select>
                            @error('status') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <input type="hidden" name="created_by" value="{{ auth()->id() ?? 1 }}">
                        <input type="hidden" name="updated_by" value="{{ auth()->id() ?? 1 }}">
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
