@php
    $cart = session('cart', []);
    $count = count($cart);
@endphp
<span class="text-sm text-center rounded-full px-1.5 bg-orange-400 text-white">{{ $count }}</span> 