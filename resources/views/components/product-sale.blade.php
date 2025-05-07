 <!-- Best seller--> 
 <div class="pl-[60px] text-2xl ">
    <p>BEST SELLER</p>
  </div>
  <div class="container mx-auto py-4 flex px-9">
    @foreach ($products  as $product_row)
        <x-product-card :productrow="$product_row"/>
    @endforeach
  </div>