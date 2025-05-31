<x-layout-admin>
    <form action="{{route('productsale.update',['productsale'=>$productsale->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="content-wrapper p-5 bg-gray-50 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-black-600">Cập nhật giá khuyến mãi</h2>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex items-center bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white shadow-md">
                            <i class="fa fa-save" aria-hidden="true"></i> Lưu
                        </button>
                        <a href="{{ route('productsale.index') }}"
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
                            <label id="product_id">
                                <strong>Sản phẩm</strong>
                            </label>
                            <select name="product_id" id="product_id" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="">Chọn sản phẩm</option>
                                @foreach ($products as $product)
                                    @if(old('product_id', $productsale->product_id) == $product->id)
                                        <option selected value="{{$product->id}}">{{$product->name}}</option>
                                    @else
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if($errors->has('product_id'))
                                <div class="text-red-500">{{$errors->first('product_id')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label id="price_sale">
                                <strong>Giá khuyến mãi</strong>
                            </label>
                            <input value="{{old('price_sale', $productsale->price_sale)}}" type="number" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhập giá khuyến mãi" name="price_sale" id="price_sale">
                            @if($errors->has('price_sale'))
                                <div class="text-red-500">{{$errors->first('price_sale')}}</div>
                            @endif
                        </div>
                        <div class="flex justify-between gap-5">
                            <div class="mb-3">
                                <label id="date_begin">
                                    <strong>Ngày bắt đầu</strong>
                                </label>
                                <input value="{{old('date_begin', $productsale->date_begin)}}" type="date" class="w-full border border-gray-300 rounded-lg p-2" name="date_begin" id="date_begin">
                                @if($errors->has('date_begin'))
                                    <div class="text-red-500">{{$errors->first('date_begin')}}</div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label id="date_end">
                                    <strong>Ngày kết thúc</strong>
                                </label>
                                <input value="{{old('date_end', $productsale->date_end)}}" type="date" class="w-full border border-gray-300 rounded-lg p-2" name="date_end" id="date_end">
                                @if($errors->has('date_end'))
                                    <div class="text-red-500">{{$errors->first('date_end')}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin> 