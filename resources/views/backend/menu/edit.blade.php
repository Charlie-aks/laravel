<x-layout-admin>
    <form action="{{ route('menu.update', ['menu' => $menu->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Cập nhật menu</h2>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save mr-1" aria-hidden="true"></i> Lưu
                        </button>
                        <a href="{{ route('menu.index') }}"
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
                        {{-- Tên menu --}}
                        <div class="mb-4">
                            <label for="name" class="font-semibold">Tên menu</label>
                            <input value="{{ old('name', $menu->name) }}" type="text" name="name" id="name"
                                   class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập tên menu">
                            @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Link --}}
                        <div class="mb-4">
                            <label for="link" class="font-semibold">Link</label>
                            <input value="{{ old('link', $menu->link) }}" type="text" name="link" id="link"
                                   class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập link menu">
                            @error('link')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Loại --}}
                        <div class="mb-4">
                            <label for="type" class="font-semibold">Loại</label>
                            <input value="{{ old('type', $menu->type) }}" type="text" name="type" id="type"
                                   class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập loại menu">
                            @error('type')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Vị trí --}}
                        <div class="mb-4">
                            <label for="position" class="font-semibold">Vị trí</label>
                            <input value="{{ old('position', $menu->position) }}" type="text" name="position" id="position"
                                   class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập vị trí menu">
                            @error('position')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mô tả --}}
                        <div class="mb-4">
                            <label for="description" class="font-semibold">Mô tả</label>
                            <textarea name="description" id="description" rows="4"
                                      class="w-full border border-gray-300 rounded-lg p-2"
                                      placeholder="Nhập mô tả menu">{{ old('description', $menu->description) }}</textarea>
                            @error('description')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Cột phải --}}
                    <div>
                              

                        {{-- Trạng thái --}}
                        <div class="mb-4">
                            <label for="status" class="font-semibold">Trạng thái</label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1" {{ old('status', $menu->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', $menu->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                            @error('status')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Thứ tự hiển thị (sort_order) --}}
                        <div class="mb-4">
                            <label for="sort_order" class="font-semibold">Thứ tự hiển thị</label>
                            <input value="{{ old('sort_order', $menu->sort_order) }}" type="number" name="sort_order" id="sort_order"
                                   class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập số thứ tự hiển thị">
                            @error('sort_order')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Người tạo (created_by) --}}
                        <div class="mb-4">
                            <label for="created_by" class="font-semibold">Người tạo</label>
                            <input value="{{ old('created_by', $menu->created_by) }}" type="text" name="created_by" id="created_by"
                                   class="w-full border border-gray-300 rounded-lg p-2" readonly>
                        </div>

                        {{-- Người sửa (updated_by) --}}
                        <div class="mb-4">
                            <label for="updated_by" class="font-semibold">Người sửa</label>
                            <input value="{{ old('updated_by', $menu->updated_by) }}" type="text" name="updated_by" id="updated_by"
                                   class="w-full border border-gray-300 rounded-lg p-2" readonly>
                        </div>

                        {{-- Menu cha --}}
                        <div class="mb-4">
                            <label for="parent_id" class="font-semibold">Menu cha</label>
                            <select name="parent_id" id="parent_id" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="0" {{ old('parent_id', $menu->parent_id) == 0 ? 'selected' : '' }}>Không có</option>
                                @foreach($list_parent as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
