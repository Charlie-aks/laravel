<x-layout-admin>
    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
        @csrf
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
                            <i class="fa fa-arrow-left"></i> Thoát
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
                            <input value="{{old('name')}}" type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập tên sản phẩm" name="name" id="name">
                            @if($errors->has('name'))
                                <div class="text-red-500">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label id="detail">
                                <strong>Chi tiết sản phẩm</strong>
                            </label>
                            <textarea name="detail" id="detail" rows="4" class="w-full border border-gray-300 rounded-lg p-2">{{old('detail')}}</textarea>
                            @if($errors->has('detail'))
                                <div class="text-red-500">{{$errors->first('detail')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label id="description">
                                <strong>Mô tả</strong>
                            </label>
                            <textarea name="description" id="description" class="w-full border border-gray-300 rounded-lg p-2">{{old('description')}}</textarea>
                        </div>
                        <div class="flex justify-between gap-5">
                            <div class="mb-3">
                                <label id="price_root">
                                    <strong>Giá bán</strong>
                                </label>
                                <input value="{{old('price_root',100)}}" type="number" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Giá bán" name="price_root" id="price_root">
                                @if($errors->has('price_root'))
                                    <div class="text-red-500">{{$errors->first('price_root')}}</div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label id="qty">
                                    <strong>Số lượng</strong>
                                </label>
                                <input value="{{old('qty')}}" type="number" class="w-full border border-gray-300 rounded-lg p-2" value="1" name="qty" min="1" id="qty">
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
                                    @if(old('category_id') == $category->id)
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
                                    @if(old('brand_id') == $brand->id)
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
                            <div id="image-preview" class="mt-2 grid grid-cols-4 gap-2"></div>
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
</x-layout-admin>
