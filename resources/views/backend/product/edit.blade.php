<x-layout-admin>
    <form action="{{route('product.update',['product'=>$product->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Thêm sản phẩm</h2>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save" aria-hidden="true"></i> Lưu
                        </button>
                        <a href="{{ route('product.index') }}"
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
                            <label id="name">
                                <strong>Tên sản phẩm</strong>
                            </label>
                            <input value="{{ old('name', $product->name) }}" type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập tên sản phẩm" name="name" id="name">
                            @if($errors->has('name'))
                                <div class="text-red-500">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label id="detail">
                                <strong>Chi tiết sản phẩm</strong>
                            </label>
                            <textarea name="detail" id="detail" rows="4" class="w-full border border-gray-300 rounded-lg p-2">{{ old('detail', $product->detail) }}</textarea>
                            @if($errors->has('detail'))
                                <div class="text-red-500">{{$errors->first('detail')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label id="description">
                                <strong>Mô tả</strong>
                            </label>
                            <textarea name="description" id="description" class="w-full border border-gray-300 rounded-lg p-2">{{old('description',$product->description)}}</textarea>
                        </div>
                        <div class="flex justify-between gap-5">
                            <div class="mb-3">
                                <label id="price_root">
                                    <strong>Giá bán</strong>
                                </label>
                                <input value="{{old('price_root',$product->price_root)}}" type="number" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Giá bán" name="price_root" id="price_root">
                                @if($errors->has('price_root'))
                                    <div class="text-red-500">{{$errors->first('price_root')}}</div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label id="price_sale">
                                    <strong>Giá khuyến mãi</strong>
                                </label>
                                <input value="{{ old('price_sale', $product->sale->price_sale ?? '') }}" type="number" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Giá khuyến mãi" name="price_sale" id="price_sale">
                                @if($errors->has('price_sale'))
                                    <div class="text-red-500">{{$errors->first('price_sale')}}</div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label id="qty">
                                    <strong>Số lượng</strong>
                                </label>
                                <input value="{{ old('qty', $product->store->qty ?? '') }}" type="number" class="w-full border border-gray-300 rounded-lg p-2" name="qty" min="1" id="qty">
                                @if($errors->has('qty'))
                                    <div class="text-red-500">{{$errors->first('qty')}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="basis-3/12">
                        <div class="mb-3">
                            <label id="category_id">
                                <strong>Danh mục</strong>
                            </label>
                            <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="">Chọn danh mục</option>
                                @foreach ($list_category as $category)
                                    @if(old('category_id',$product->category_id) == $category->id)
                                        <option selected value="{{$category->id}}">{{$category->name}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if($errors->has('category_id'))
                                <div class="text-red-500">{{$errors->first('category_id')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label id="brand_id">
                                <strong>Thương hiệu</strong>
                            </label>
                            <select name="brand_id" id="brand_id" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="">Chọn thương hiệu</option>
                                @foreach ($list_brand as $brand)
                                    @if(old('brand_id',$product->brand_id) == $brand->id)
                                        <option selected value="{{$brand->id}}">{{$brand->name}}</option>
                                    @else
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if($errors->has('brand_id'))
                                <div class="text-red-500">{{$errors->first('brand_id')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label id="thumbnail">
                                <strong>Hình ảnh</strong>
                            </label>
                            <input type="file" class="w-full border border-gray-300 rounded-lg p-2" name="thumbnail[]" id="thumbnail" multiple accept="image/*">
                            <div id="image-preview" class="mt-2 grid grid-cols-4 gap-2">
                                @foreach($product->productimage as $image)
                                    <div class="relative group">
                                        <img src="{{ asset('assets/images/product/' . $image->thumbnail) }}" 
                                             class="w-full h-24 object-cover rounded-lg" 
                                             alt="Product Image">
                                        <button type="button" 
                                                class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity"
                                                onclick="deleteImage({{ $image->id }})">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            @if($errors->has('thumbnail'))
                                <div class="text-red-500">{{$errors->first('thumbnail')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label id="status">
                                <strong>Trạng thái</strong>
                            </label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1">Xuất bản</option>
                                <option value="0">Không xuất bản</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        // Preview ảnh khi chọn file
        document.getElementById('thumbnail').addEventListener('change', function(e) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = ''; // Clear existing previews
            
            [...e.target.files].forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg" alt="Preview">
                    `;
                    preview.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        });

        // Xóa ảnh
        function deleteImage(id) {
            if (confirm('Bạn có chắc muốn xóa ảnh này?')) {
                fetch(`/admin/product/image/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Xóa element khỏi DOM
                        const imageElement = document.querySelector(`[data-image-id="${id}"]`);
                        if (imageElement) {
                            imageElement.remove();
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
</x-layout-admin>
