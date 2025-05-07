@if ($menu_list->isNotEmpty())
    <li class="relative group menu-item">
        <a href="{{ $menu->link }}" class="inline-block p-4 text-lg text-black hover:text-blue-500">
            {{ $menu->name }}
        </a>
        <ul class="absolute left-0 top-full invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-300 bg-white shadow-lg rounded-md mt-2 min-w-[200px] z-50">
            @foreach ($menu_list as $item)
                <li class="menu-item">
                    <a href="{{ $item->link }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-500">
                        {{ $item->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
@else
    <li class="menu-item">
        <a href="{{ $menu->link }}" class="inline-block p-4 text-lg text-black hover:text-blue-500">
            {{ $menu->name }}
        </a>
    </li>
@endif
