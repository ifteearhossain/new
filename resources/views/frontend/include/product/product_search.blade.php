<aside class="widget widget_shop">
    <h4 class="widget-title">PRODUCT NAME</h4>
    <form  action="{{ route('productPage.search') }}" method="get">
      <div class="pb-5">
        <input name="product_name" class="form-control" type="text" placeholder="Enter Product Name">
      </div>
 

    <figure class="ps-custom-scrollbar" data-height="250">
        @php
            $counter = 1;
        @endphp
        @foreach (productsByBrand() as $brand)
        <div class="ps-checkbox">
            <input name="product_brand" value="{{ $brand->product_brand }}" class="form-control" type="radio" id="brand-{{ $counter }}" name="brand">
            <label for="brand-{{ $counter }}">{{ $brand->product_brand }}</label>
        </div>
        @php
            $counter++;
        @endphp
        @endforeach
    </figure>
    <figure>
        <h4 class="widget-title">By Price</h4>
        {{-- <div class="ps-slider" data-default-min="100" data-default-max="10000" data-max="10000" data-step="100" data-unit="$">

        </div>
        <p class="ps-slider__meta">Price:<span class="ps-slider__value ps-slider__min"></span>-<span class="ps-slider__value ps-slider__max"></span></p> --}}
        <div class="py-3">
            <input name="min_price" type="number" class="form-control" placeholder="Minimum Price" value="100">
        </div>
       <div>
        <input type="number" name="max_price" class="form-control" placeholder="Maximum Price" value="100000">
       </div>
       <div class="py-3">
           <input type="submit" value="Filter Product" class="form-control bg-dark text-white" style="cursor: pointer;">
       </div>
    </form>
    </figure>

    {{-- <figure>
        <h4 class="widget-title">By Color</h4>
        <div class="ps-checkbox ps-checkbox--color color-1 ps-checkbox--inline">
            <input class="form-control" type="checkbox" id="color-1" name="size">
            <label for="color-1"></label>
        </div>
        <div class="ps-checkbox ps-checkbox--color color-2 ps-checkbox--inline">
            <input class="form-control" type="checkbox" id="color-2" name="size">
            <label for="color-2"></label>
        </div>
        <div class="ps-checkbox ps-checkbox--color color-3 ps-checkbox--inline">
            <input class="form-control" type="checkbox" id="color-3" name="size">
            <label for="color-3"></label>
        </div>
        <div class="ps-checkbox ps-checkbox--color color-4 ps-checkbox--inline">
            <input class="form-control" type="checkbox" id="color-4" name="size">
            <label for="color-4"></label>
        </div>
        <div class="ps-checkbox ps-checkbox--color color-5 ps-checkbox--inline">
            <input class="form-control" type="checkbox" id="color-5" name="size">
            <label for="color-5"></label>
        </div>
        <div class="ps-checkbox ps-checkbox--color color-6 ps-checkbox--inline">
            <input class="form-control" type="checkbox" id="color-6" name="size">
            <label for="color-6"></label>
        </div>
        <div class="ps-checkbox ps-checkbox--color color-7 ps-checkbox--inline">
            <input class="form-control" type="checkbox" id="color-7" name="size">
            <label for="color-7"></label>
        </div>
        <div class="ps-checkbox ps-checkbox--color color-8 ps-checkbox--inline">
            <input class="form-control" type="checkbox" id="color-8" name="size">
            <label for="color-8"></label>
        </div>
    </figure> --}}
    {{-- <figure class="sizes">
        <h4 class="widget-title">BY SIZE</h4><a href="#">L</a><a href="#">M</a><a href="#">S</a><a href="#">XL</a>
    </figure> --}}
</aside>