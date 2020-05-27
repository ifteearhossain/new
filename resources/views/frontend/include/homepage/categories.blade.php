<div class="ps-top-categories">
    <div class="ps-container">
        <h3>Categories</h3>
        <div class="row">
            @foreach ($categories->take(8) as $category)
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 ">
                <div class="ps-block--category"><a class="ps-block__overlay" href="{{ route('category.product', $category->id) }}"></a><img src="{{ asset('uploads/category') }}/{{ $category->category_image }}" alt="">
                    <p>{{ $category->category_name }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>