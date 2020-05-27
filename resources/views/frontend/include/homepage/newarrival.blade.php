<div class="ps-product-list ps-new-arrivals">
    <div class="ps-container">
        <div class="ps-section__header">
            <h3>Hot New Arrivals</h3>
            <ul class="ps-section__links">
                    @foreach ($categories->take(5) as $category)    
                    <li><a href="{{ route('category.product', $category->id) }}">{{ $category->category_name }}</a></li>
                    @endforeach

                    <li><a href="{{ route('front.product') }}">View All</a></li>
            </ul>
        </div>
        <div class="ps-section__content">
            <div class="row">
                @foreach ($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 ">
                    <div class="ps-product--horizontal">
                        <div class="ps-product__thumbnail"><a href="{{ route('product.details', $product->product_slug) }}"><img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt=""></a></div>
                        
                        <div class="ps-product__content"><a class="ps-product__title" href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a>
                         
                            <div class="ps-product__rating">
                                <select class="ps-rating" data-read-only="true">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                    <option value="2">5</option>
                                </select><span>04</span>
                            </div>
                            @if($product->discount_price != null)
                              <div class="ps-product__badge">-{{ floor(($product->product_price - $product->discount_price)/($product->product_price) * 100) }}%</div>
                            @endif
                            <p class="ps-product__price sale">${{ ($product->discount_price != null) ? $product->discount_price : $product->product_price }} </p>
                             
                            @if($product->discount_price != null)
                               <del>${{ $product->product_price }} </del>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
               
            </div>
        </div>
    </div>
</div>