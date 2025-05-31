<x-layout-admin>
    <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-black-600">Chi tiết sản phẩm</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                        class="flex items-center bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-white shadow-md">
                        <i class="fa fa-edit"></i> Chỉnh sửa
                    </a>
                    <a href="{{ route('product.index') }}"
                        class="flex items-center bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded-lg text-white shadow-md">
                        <i class="fa fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <div class="flex gap-6">
                <!-- Left Column - Product Images -->
                <div class="basis-1/3">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Hình ảnh sản phẩm</h3>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($product->productimage as $image)
                                <div class="relative">
                                    <img src="{{ asset('assets/images/product/' . $image->thumbnail) }}" 
                                         class="w-full h-48 object-cover rounded-lg" 
                                         alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Column - Product Details -->
                <div class="basis-2/3">
                    <div class="space-y-4">
                        <!-- Basic Information -->
                        <div class="border-b pb-4">
                            <h3 class="text-lg font-semibold mb-3">Thông tin cơ bản</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-600">Tên sản phẩm:</p>
                                    <p class="font-medium">{{ $product->name }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Mã sản phẩm:</p>
                                    <p class="font-medium">#{{ $product->id }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Danh mục:</p>
                                    <p class="font-medium">{{ $product->categoryname }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Thương hiệu:</p>
                                    <p class="font-medium">{{ $product->brandname }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing and Stock -->
                        <div class="border-b pb-4">
                            <h3 class="text-lg font-semibold mb-3">Giá và tồn kho</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-600">Giá bán:</p>
                                    <p class="font-medium text-red-600">{{ number_format($product->price_root, 0, ',', '.') }}₫</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Số lượng tồn kho:</p>
                                    <p class="font-medium">{{ $product->store->qty ?? '0' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Trạng thái:</p>
                                    <p class="font-medium">
                                        @if($product->status == 1)
                                            <span class="text-green-600">Đang hiển thị</span>
                                        @else
                                            <span class="text-gray-600">Đang ẩn</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="border-b pb-4">
                            <h3 class="text-lg font-semibold mb-3">Chi tiết sản phẩm</h3>
                            <div class="prose max-w-none">
                                {!! $product->detail !!}
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <h3 class="text-lg font-semibold mb-3">Mô tả</h3>
                            <div class="prose max-w-none">
                                {!! $product->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-admin> 