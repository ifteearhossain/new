@extends('layouts.dashboard')

@section('title')
   Product
@endsection

@section('products-active')
  active
@endsection

@section('breadcrumb')

@isset($product)
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }} ">
     @if (Auth::user()->user_role == 0)
       Master Admin Home
     @elseif (Auth::user()->user_role == 1)
       Admin Dashboard
     @elseif (Auth::user()->user_role == 2)
       Seller Dashboard
     @else
       Customer Dashboard
     @endif
     </a>
    <a class="breadcrumb-item" href="{{ route('products.index') }}">Product</a>
    <span class="breadcrumb-item active">{{ $product->product_name }}</span>
  </nav>
@else
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="
        @if (Auth::user()->user_role == 0)
          {{ route('home') }}
        @elseif (Auth::user()->user_role == 1)
          {{ route('admin.index') }}
        @elseif (Auth::user()->user_role == 2)
          {{ route('seller.index') }}
        @else
          {{ route('customer.index') }}
        @endif
     ">
     @if (Auth::user()->user_role == 0)
       Master Admin Home
     @elseif (Auth::user()->user_role == 1)
       Admin Dashboard
     @elseif (Auth::user()->user_role == 2)
       Seller Dashboard
     @else
       Customer Dashboard
     @endif
     </a>
    {{-- <a class="breadcrumb-item" href="{{ route('category.index') }}">Category</a> --}}
    <span class="breadcrumb-item active">Add Product</span>
  </nav>
@endisset

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('inline-css')
  <style>
      #upload {
    opacity: 0;
}

#upload-label {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
}

.image-area {
    border: 2px dashed rgba(0, 0, 0, 0.4);
    padding: 1rem;
    position: relative;
}

.image-area::before {
    content: 'Uploaded image result';
    color: #444;
    font-weight: bold;
    text-transform: uppercase;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.8rem;
    z-index: 1;
}

.image-area img {
    z-index: 2;
    position: relative;
}
.input-group {
    border:1px solid rgba(0, 0, 0, 0.15);
    border-radius: 5px;
}
  </style>
@endsection

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
            <h1> {{ isset($product)? 'Edit Product' : 'Add Product' }}</h1>
            </div>
            <div class="card-body">
                @if($errors->all())
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">
                    <li>{{ $error }}</li>
                  </div>
                @endforeach
            @endif


            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
               <form action="{{ isset($product)? route('products.update', $product->id) : route('products.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                @if (isset($product))
                    {{ method_field('PUT') }}
                @endif
                   @csrf
                <div class="py-3">
                    <label for="name">Product name</label>
                    <input class="form-control" id="name" type="text" name="product_name" placeholder="Add Product name" value="{{ isset($product)?$product->product_name : '' }}">
                    @error ('product_name')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="py-3">
                    <label for="price">Product price (Place your price in USD only)</label>
                    <input class="form-control" id="price" type="text" name="product_price" placeholder="Add Product price" value="{{ isset($product)?$product->product_price : '' }}">
                    @error ('product_price')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="py-3">
                    <label for="price">Product discount Price (Optional) (Place your price in USD only)</label>
                    <input class="form-control" id="price" type="text" name="discount_price" placeholder="Add Product discount price" value="{{ isset($product)?$product->discount_price : '' }}">
                    @error ('discount_price')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="py-3">
                    <label for="brand">Product brand (Optional)</label>
                    <input class="form-control" id="brand" type="text" name="product_brand" placeholder="Add Product Brand (Optional)" value="{{ isset($product)?$product->product_brand : '' }}">
                    @error ('product_brand')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="py-3">
                    <label for="category">Category</label>
                    <select class="form-control" name="category_id" id="category">
                        <option value="">--Select Category--</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}"
                            @isset($product)
                              @if ($product->category_id === $category->id)
                                selected
                              @endif
                            @endisset
                            >{{ $category->category_name }}</option>
                        @endforeach
                      </select>
                    @error ('category_id')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="py-3">
                    <label for="sub_category">Sub category</label>
                    <select class="form-control" name="sub_category_id" id="sub_category">
                        <option value="">--Select Sub category--</option>
                        @isset($product)
                          @foreach ($sub_categories as $sub_category)
                          <option value="{{ $sub_category->id }}"
                            @if ($product->sub_category_id === $sub_category->id)
                              selected
                            @endif
                            >{{ $sub_category->sub_category_name }}</option>
                            @endforeach
                            @endisset
                      </select>
                    @error ('sub_category_id')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="py-3">
                    <label for="shop">Shop</label>
                    <select name="shop_id" id="shop" class="form-control">
                        <option value="" {{ (user_role() == 2) ? 'hidden' : ''  }}>--Select Shop--</option>
                        @if(user_role() == 2)
                          @foreach ($shops as $shop)
                          <option value="{{ $shop->id }}" {{ (Auth::user()->shop_id == $shop->id) ? 'selected' : 'hidden' }}>{{ $shop->shop_name }}</option>
                         @endforeach
                         @else 
                         @foreach ($shops as $shop)
                         <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                        @endforeach
                        @endif
                    </select>
                    @error ('shop_id')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="py-3">
                    <label for="qty">Product Quantity</label>
                    <input id="qty" type="text" class="form-control" name="product_quantity" placeholder="Product quantity" value="{{ $product->product_quantity ?? "" }}">
                    @error ('product_quantity')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="py-3">
                    <label for="short_desc">Product short description</label>
                    <input id="short_desc" type="hidden" name="product_short_description" value="{{ $product->product_short_description ?? "" }}">
                    <trix-editor input="short_desc" placeholder="Product short description"></trix-editor>
                    @error ('product_short_description')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="py-3">
                    <label for="long_desc">Product long description</label>
                    <input id="long_desc" type="hidden" name="product_long_description"  value="{{ $product->product_long_description ?? "" }}">
                    <trix-editor input="long_desc" placeholder="Product long description"></trix-editor>
                    @error ('product_long_description')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                
                @isset($product)
                    <div class="py-3 text-center">
                        <img src="{{ asset('uploads/products/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt="Not found" width="200">
                    </div>
                @endisset
                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                    <input name="product_thumbnail_image" id="upload" type="file" onchange="readURL(this);" class="form-control">
                    <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                    <div class="input-group-append">
                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"><i style="margin-right:5px; color:#444;" class="fas fa-cloud-upload-alt"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                    </div>
                    @error ('product_thumbnail_image')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
    
                <!-- Uploaded image area-->
                <p class="font-italic text-dark text-center">The image uploaded will be rendered inside the box below.</p>
                <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
              
                <div class="py-3 text-center">
                 @isset($product)
                 @foreach ($product->getmultipleimage as $image)     
                 <img src="{{ asset('uploads/products/product_multiple_image') }}/{{ $image->product_multiple_image }}" alt="Not found" width="200">
                 @endforeach
                 @endisset
                </div>
                <label for="upload_multi" class="mt-3">Product Multiple Image</label>
                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                    <input name="product_multiple_image[]" id="upload-multi" type="file" class="form-control" multiple>
                    @error ('product_multiple_image')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
    
                
                <div class="py-3">
                    <button class="btn btn-success btn-sm" type="submit">
                        @if(isset($product))
                        Update Product
                        @else
                        Add Product
                        @endif
                    </button>


                </div>
               </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
  <script>
      /*  ==========================================
SHOW UPLOADED IMAGE
* ========================================== */
function readURL(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#imageResult')
            .attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
}
}

$(function () {
$('#upload').on('change', function () {
    readURL(input);
});
});

/*  ==========================================
SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
var input = event.srcElement;
var fileName = input.files[0].name;
infoArea.textContent = 'File name: ' + fileName;
}
  </script>
  <script>
    $(document).ready(function(){
      $("#category").change(function(){
        var category  = $(this).val();

        // Ajax Default Code Starts 
        $.ajaxSetup({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Ajax Default Code Ends

        // Ajax Request Starts

         $.ajax({
           type: 'POST',
           url: '/get/subcategory',
           data: {category:category},
           success: function(data){
             $("#sub_category").html(data);
           }
         }); 

        // Ajax Request Ends 
      });
    });
  </script>
@endsection
