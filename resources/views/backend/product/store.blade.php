<x-layout-admin>
    <div class="content-wrapper bg-white">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <div class="">
                    <h2 class="text-xl font-bold text-blue-300">Quản lý kho - {{ $product->name }}</h2>
                </div>
                <div class="text-right">
                    <a href="{{ route('product.index') }}" class="bg-blue-300 px-2 py-2 rounded-xl mx-1 text-white">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Quay lại
                    </a>
                </div>
            </div>
        </div>

        <div class="border border-blue-100 rounded-lg p-2">
            <form action="{{ route('product.store.update', ['product' => $product->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label for="qty" class="block text-sm font-medium text-gray-700">
                            <strong>Số lượng trong kho</strong>
                        </label>
                        <input type="number" 
                               name="qty" 
                               id="qty" 
                               value="{{ old('qty', $product->store->qty ?? 0) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-lg p-2"
                               min="0"
                               required>
                        @if($errors->has('qty'))
                            <div class="text-red-500">{{ $errors->first('qty') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="price_root" class="block text-sm font-medium text-gray-700">
                            <strong>Giá nhập</strong>
                        </label>
                        <input type="number" 
                               name="price_root" 
                               id="price_root" 
                               value="{{ old('price_root', $product->store->price_root ?? 0) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-lg p-2"
                               min="0"
                               required>
                        @if($errors->has('price_root'))
                            <div class="text-red-500">{{ $errors->first('price_root') }}</div>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                        <i class="fa fa-save" aria-hidden="true"></i> Lưu thay đổi
                    </button>
                </div>
            </form>

            <!-- Lịch sử nhập kho -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Lịch sử nhập kho</h3>
                <table class="border-collapse border-gray-400 w-full">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 p-2">Ngày</th>
                            <th class="border border-gray-300 p-2">Số lượng</th>
                            <th class="border border-gray-300 p-2">Giá nhập</th>
                            <th class="border border-gray-300 p-2">Người cập nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($storeHistory as $history)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $history->created_at->format('d/m/Y H:i') }}</td>
                            <td class="border border-gray-300 p-2">{{ $history->qty }}</td>
                            <td class="border border-gray-300 p-2">{{ number_format($history->price_root) }} VNĐ</td>
                            <td class="border border-gray-300 p-2">{{ $history->updated_by_name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-admin> 