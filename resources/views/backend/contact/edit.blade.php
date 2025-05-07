<x-layout-admin>
    <form action="{{ route('contact.update', ['contact' => $contact->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Cập nhật liên hệ</h2>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save mr-1" aria-hidden="true"></i> Lưu
                        </button>
                        <a href="{{ route('contact.index') }}"
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
                        {{-- Tên liên hệ --}}
                        <div class="mb-4">
                            <label for="name" class="font-semibold">Tên liên hệ</label>
                            <input value="{{ old('name', $contact->name) }}" type="text" name="name" id="name"
                                   class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập tên">
                            @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Số điện thoại --}}
                        <div class="mb-4">
                            <label for="phone" class="font-semibold">Số điện thoại</label>
                            <input value="{{ old('phone', $contact->phone) }}" type="text" name="phone" id="phone"
                                   class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập số điện thoại">
                            @error('phone')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label for="email" class="font-semibold">Email</label>
                            <input value="{{ old('email', $contact->email) }}" type="email" name="email" id="email"
                                   class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập email">
                            @error('email')
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
                                <option value="1" {{ old('status', $contact->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', $contact->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                            @error('status')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Người tạo --}}
                        <div class="mb-4">
                            <label for="created_by" class="font-semibold">Người tạo</label>
                            <input value="{{ old('created_by', $contact->created_by) }}" type="text" name="created_by" id="created_by"
                                   class="w-full border border-gray-300 rounded-lg p-2" readonly>
                        </div>
                    </div>
                </div>
                {{-- Tiêu đề --}}
                <div class="mb-4">
                    <label for="title" class="font-semibold">Tiêu đề</label>
                    <input value="{{ old('title', $contact->title) }}" type="text" name="title" id="title"
                           class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập tiêu đề">
                    @error('title')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nội dung --}}
                <div class="mb-4">
                    <label for="content" class="font-semibold">Nội dung</label>
                    <textarea name="content" id="content" rows="5"
                              class="w-full border border-gray-300 rounded-lg p-2"
                              placeholder="Nhập nội dung liên hệ">{{ old('content', $contact->content) }}</textarea>
                    @error('content')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
