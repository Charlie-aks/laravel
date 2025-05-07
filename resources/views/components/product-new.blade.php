<div class="pl-[60px] mt-[10px] text-2xl">
    <p>NEW ARRIVAL</p>
  </div>  
  <div class="container mx-auto py-4 flex px-9">
   @foreach ($products as $product)
    <x-product-card :productrow="$product" />
    
   @endforeach
  </div>