@extends('layouts.frontend')

@section('title')
    Ekomalls | Home
@endsection

@section('content')


    {{-- Banner Part Starts --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif 
    @if($errors->all())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif 
    @include('frontend.include.homepage.banner')


    {{-- Banner Part Ends --}}
    
    {{-- All Discounted Products Starts --}}
    
    @include('frontend.include.homepage.discount', ['discountProducts' => $discountProducts])

    {{-- All Discounted Products Ends --}}

    {{-- All Categories Slider Starts --}}

    @include('frontend.include.homepage.categories', ['categories' => $categories])

    {{-- All Categories Slider Ends --}}

    {{-- Electronic Products Starts --}}

    @include('frontend.include.homepage.electronics', ['productsElectronics' => $productsElectronics])

    {{-- Electronic Products Ends --}}

    {{-- Men's Products Starts --}}

    @include('frontend.include.homepage.mens', ['productsMens' => $productsMens])

    {{-- Men's Products Ends --}}

    {{-- Women's Products Starts --}}

    @include('frontend.include.homepage.womens', ['productsWomens' => $productsWomens])

    {{-- Women's Products Ends --}}

    {{-- Sport's Products Starts --}}

    @include('frontend.include.homepage.sports', ['productsSports' => $productsSports])

    {{-- Sport's Products Ends --}}

    {{-- Home Ad Starts --}}

    @include('frontend.include.homepage.homead', ['bannersFooter' => $bannersFooter])

    {{-- Home Ad Ends --}}


          {{-- Pricing plan Starts --}}

          {{-- hidden in pricing.blade.php --}}

          {{-- Pricing plan end --}}
 

    {{-- New Arrival Starts --}}

    @include('frontend.include.homepage.newarrival', ['products' => $products, 'categories' => $categories])

    {{-- New Arrival Ends --}}


@endsection

