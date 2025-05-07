<nav class="w-5/6 flex justify-center">
    <ul class="flex space-x-6 text-gray-600 font-medium text-base cursor-pointer uppercase">
     @foreach ($menu_list as $menu_item)
         <x-main-menu-item :menuitem="$menu_item"/>
     @endforeach
    </ul>
  </nav>
  