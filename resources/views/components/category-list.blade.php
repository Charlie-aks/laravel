<div class="mb-5">
    <h3 class="text-[#1a1a1a] font-bold uppercase text-2xl mb-2">Danh mục</h3>
    <div class="relative">
        <select id="category-select"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-300">
            <option value="">-- Chọn danh mục --</option>
            @foreach($category_list as $category)
                <option value="{{ $category->slug }}" {{ request('category_slug') == $category->slug ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>