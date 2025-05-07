<div class="mb-5">
    <h3 class="text-[#1a1a1a] font-bold uppercase text-2xl mb-2">Thương hiệu</h3>
    <div class="relative">
        <select onchange="if(this.value) window.location.href=this.value"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-300">
            <option value="">-- Chọn thương hiệu --</option>
            @foreach($brand_list as $brand)
                <option value="{{ route('site.product') }}?brand_slug={{ $brand->slug }}">
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>