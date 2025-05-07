<x-layout-admin>
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Thêm Đơn hàng</h2>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save mr-2" aria-hidden="true"></i> Lưu
                        </button>
                        <a href="{{ route('order.index') }}" class="flex items-center bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-arrow-left mr-2"></i> Thoát
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-4">
                <!-- User ID -->
                <input type="hidden" name="user_id" value="1">

                <!-- Số điện thoại -->
                <div class="mb-3">
                    <label for="phone"><strong>Số điện thoại</strong></label>
                    <input value="{{ old('phone') }}" type="text" name="phone" id="phone" placeholder="Nhập số điện thoại" class="w-full border border-gray-300 rounded-lg p-2">
                    @error('phone') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email"><strong>Email</strong></label>
                    <input value="{{ old('email') }}" type="email" name="email" id="email" placeholder="Nhập email" class="w-full border border-gray-300 rounded-lg p-2">
                    @error('email') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <!-- Địa chỉ -->
                <div class="mb-3">
                    <label for="address"><strong>Địa chỉ</strong></label>
                    <input value="{{ old('address') }}" type="text" name="address" id="address" placeholder="Nhập địa chỉ" class="w-full border border-gray-300 rounded-lg p-2">
                    @error('address') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <!-- Ghi chú -->
                <div class="mb-3">
                    <label for="note"><strong>Ghi chú</strong></label>
                    <textarea name="note" id="note" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập ghi chú đơn hàng">{{ old('note') }}</textarea>
                    @error('note') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <!-- Trạng thái -->
                <div class="mb-3">
                    <label for="status"><strong>Trạng thái</strong></label>
                    <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tạm ẩn</option>
                    </select>
                    @error('status') <div class="text-red-500">{{ $message }}</div> @enderror
                </div>

                <!-- updated_by -->
                <input type="hidden" name="created_by" value="1">
                <input type="hidden" name="updated_by" value="1">
            </div>
        </div>
    </form>
</x-layout-admin>
