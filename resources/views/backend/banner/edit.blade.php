<x-layout-admin>
    <form action="{{ route('banner.update', ['banner' => $banner->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Cập nhật banner</h2>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save" aria-hidden="true"></i> Lưu
                        </button>
                        <a href="{{ route('banner.index') }}"
                           class="flex items-center bg-blue-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-arrow-left"></i> Về Danh Sách
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex gap-6">
                    <div class="basis-9/12">
                        <div class="mb-3">
                            <label for="name">
                                <strong>Tên banner</strong>
                            </label>
                            <input value="{{ old('name', $banner->name) }}" type="text" class="w-full border border-gray-300 rounded-lg p-2"
                                   placeholder="Nhập tên banner" name="name" id="name">
                            @if($errors->has('name'))
                                <div class="text-red-500">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="description">
                                <strong>Mô tả</strong>
                            </label>
                            <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded-lg p-2"
                                      placeholder="Nhập mô tả">{{ old('description', $banner->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="text-red-500">{{ $errors->first('description') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="position">
                                <strong>Vị trí hiển thị</strong>
                            </label>
                            <input value="{{ old('position', $banner->position) }}" type="text" class="w-full border border-gray-300 rounded-lg p-2"
                                   placeholder="Ví dụ: slide chính, bên phải, dưới cùng..." name="position" id="position">
                            @if($errors->has('position'))
                                <div class="text-red-500">{{ $errors->first('position') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="basis-3/12">
                        <div class="mb-3">
                            <label for="image">
                                <strong>Hình ảnh</strong>
                            </label>
                            <input type="file" class="w-full border border-gray-300 rounded-lg p-2" name="image" id="image">
                            @if($errors->has('image'))
                                <div class="text-red-500">{{ $errors->first('image') }}</div>
                            @endif

                            @if($banner->image)
                                <div class="mt-2">
                                    <img src="{{ asset('assets/images/banner/' . $banner->image) }}" alt="Thumbnail" class="w-full h-auto rounded">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="status">
                                <strong>Trạng thái</strong>
                            </label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1" {{ old('status', $banner->status) == 1 ? 'selected' : '' }}>Xuất bản</option>
                                <option value="0" {{ old('status', $banner->status) == 0 ? 'selected' : '' }}>Không xuất bản</option>
                            </select>
                            @if($errors->has('status'))
                                <div class="text-red-500">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
