<x-layout-admin>
    <form action="{{ route('contact.store') }}" method="post">
        @csrf
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Thêm Liên hệ</h2>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save"></i> Lưu
                        </button>
                        <a href="{{ route('contact.index') }}" class="flex items-center bg-blue-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-arrow-left"></i> Thoát
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex gap-6">
                    <div class="basis-9/12">
                        <div class="mb-3">
                            <label for="name"><strong>Tên liên hệ</strong></label>
                            <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập tên liên hệ" value="{{ old('name') }}">
                            @error('name') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email"><strong>Email</strong></label>
                            <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập email" value="{{ old('email') }}">
                            @error('email') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone"><strong>Số điện thoại</strong></label>
                            <input type="text" name="phone" id="phone" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                            @error('phone') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title"><strong>Tiêu đề</strong></label>
                            <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập tiêu đề liên hệ" value="{{ old('title') }}">
                            @error('title') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content"><strong>Nội dung</strong></label>
                            <textarea name="content" id="content" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập nội dung liên hệ">{{ old('content') }}</textarea>
                            @error('content') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="reply_id"><strong>Reply ID (mặc định là 0)</strong></label>
                            <input type="number" name="reply_id" id="reply_id" class="w-full border border-gray-300 rounded-lg p-2" value="{{ old('reply_id', 0) }}">
                            @error('reply_id') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <input type="hidden" name="user_id" value="1">
                    </div>

                    <div class="basis-3/12">
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
