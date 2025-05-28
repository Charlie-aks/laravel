<div x-data="{ isOpen: false }" class="relative">
    <!-- Mobile menu button -->
    <button @click="isOpen = !isOpen" class="md:hidden p-2 rounded-md hover:bg-gray-100 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <!-- Mobile menu dropdown -->
    <div 
        x-show="isOpen" 
        @click.away="isOpen = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
    >
        <div class="py-1">
            <a href="{{ route('site.home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Trang chủ</a>
            <a href="{{ route('site.product') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sản phẩm</a>
            <a href="{{ route('site.about') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Về chúng tôi</a>
            <a href="{{ route('site.contact') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Liên hệ</a>
            <a href="{{ route('site.post.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Bài viết</a>
        </div>
    </div>
</div> 