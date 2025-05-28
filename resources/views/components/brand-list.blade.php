<div class="mb-5">
    <h3 class="text-[#1a1a1a] font-bold uppercase text-2xl mb-2">Thương hiệu</h3>
    <div class="relative">
        <select id="brand-select"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-300">
            <option value="">-- Chọn thương hiệu --</option>
            @foreach($brand_list as $brand)
                <option value="{{ $brand->slug }}" {{ request('brand_slug') == $brand->slug ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>