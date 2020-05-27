@extends('layouts.dashboard')

@section('title')
   Shops
@endsection

@section('shops-active')
  active
@endsection

@section('breadcrumb')

@isset($shop)
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">
     @if (user_role() == 0)
       Master Admin Home
     @elseif (user_role() == 1)
       Admin Dashboard
     @elseif (user_role() == 2)
       Seller Dashboard
     @else
       Customer Dashboard
     @endif
     </a>
    <a class="breadcrumb-item" href="{{ route('shops.index') }}">Shop</a>
    <span class="breadcrumb-item active">{{ $shop->shop_name }}</span>
  </nav>
@else
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">
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
    <span class="breadcrumb-item active">Create Your Shop</span>
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
            <h1> {{ isset($shop)? 'Edit Shop' : 'Add Shop' }}</h1>
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
               <form action="{{ isset($shop)? route('shops.update', $shop->id) : route('shops.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                @if (isset($shop))
                    {{ method_field('PUT') }}
                @endif
                   @csrf
                  <div class="py-3">
                    <label for="name">Shop name</label>
                    <input class="form-control" id="name" type="text" name="shop_name" placeholder="Add Shop name" value="{{ isset($shop) ? $shop->shop_name : old('shop_name') }}">
                    @error ('shop_name')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="py-3">
                    <label for="short_desc">Shop short description</label>
                    <input id="short_desc" type="hidden" name="shop_short_description" value="{{ $shop->shop_short_description ??  old('shop_short_description') }}">
                    <trix-editor input="short_desc" placeholder="Shop short description"></trix-editor>
                    @error ('shop_short_description')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="py-3">
                    <label for="long_desc">Shop long description (Optional)</label>
                    <input id="long_desc" type="hidden" name="shop_long_description"  value="{{ $shop->shop_long_description ?? old('shop_long_description') }}">
                    <trix-editor input="long_desc" placeholder="Shop long description"></trix-editor>
                    @error ('shop_long_description')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="py-3">
                    <label for="address">Shop address</label>
                    <input id="address" type="hidden" name="shop_address"  value="{{ $shop->shop_address ?? old('shop_address') }}">
                    <trix-editor input="address" placeholder="Shop address"></trix-editor>
                    @error ('shop_address')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="py-3">
                  <label for="name">Shop phone number</label>
                  
                  <input style="width:95%; float:right;" class="form-control" id="name" type="text" name="shop_phone_number" placeholder="phone number" value="{{ isset($shop) ? $shop->shop_phone_number : Auth::user()->phone_number }}" {{ isset($shop) ? 'readonly' : ''  }}>

                    <input type="text" name="areacode" class="form-control" style="width:5%;" placeholder="Areacode" value="{{ isset($shop) ? $shop->areacode : Auth::user()->areacode }}" {{ isset($shop) ? 'readonly' : ''  }}>
                  @error ('shop_phone_number')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
              </div>
            @isset($shop)
            <div class="text-center">
              <img src="{{ asset('uploads/shops/logo') }}/{{ $shop->shop_logo }}" alt="Not Found" width="200">
            </div>
            @endisset
              <div class="py-3">
                
                <label for="logo">Shop Logo</label>
                <input type="file" class="form-control" id="logo" name="shop_logo" value="{{ old('shop_logo') }}">
                @error ('shop_logo')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
                
                @isset($shop)
                    <div class="py-3 text-center">
                      <img src="{{ asset('uploads/shops/cover') }}/{{ $shop->shop_cover_image }}" alt="Not Found" width="200">
                    </div>
                @endisset
                 <label class="my-3" for="">Shop Cover image</label>
                 <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                  <input name="shop_cover_image" id="upload" type="file" onchange="readURL(this);" class="form-control" value="{{ old('shop_cover_image') }}">
                  <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                  <div class="input-group-append">
                      <label for="upload" class="btn btn-light m-0 rounded-pill px-4"><i style="margin-right:5px; color:#444;" class="fas fa-cloud-upload-alt"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                  </div>
                  @error ('shop_cover_image')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
  
              <!-- Uploaded image area-->
              <p class="font-italic text-white text-center">The image uploaded will be rendered inside the box below.</p>
              <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
    
                
              <div class="head pt-5 pb-3">
                <h5 class="text-center">Verify Your Business Details</h5>
              </div>

              <div class="py-3">
                <label for="shop_license">Enter Your business license number</label>
                <input id="shop_license" name="shop_registration_number" type="text" class="form-control" placeholder="Enter Your business license number" value="{{ isset($shop) ? $shop->shop_registration_number : old('shop_registration_number') }}">
                @error ('shop_registration_number')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="py-3">
                <label for="license">Business legal documents (Pdf only)</label>
                <input name="shop_license" id="license" type="file" class="form-control" value="{{ old('shop_license') }}">
                @error ('shop_license')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="head pt-5 pb-3">
                <h5 class="text-center">Your Bank Information so that we can pay you</h5>
              </div>

              <div class="py-3">
                <label for="bank_name">Bank name</label>
                <input id="bank_name" name="bank_name" type="text" class="form-control" placeholder="Enter Your bank name" value="{{ isset($shop) ? $shop->bank_name : "" }}">
                @error ('bank_name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="py-3">
                <label for="bank_account">Bank Account number</label>
                <input id="bank_account" name="bank_account_number" type="text" class="form-control" placeholder="Enter Your bank account number" value="{{ isset($shop) ? $shop->bank_account_number : '' }}">
                @error ('bank_account_number')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="py-3">
                <label for="paypal_account">PayPal Account (Optional)</label>
                <input id="paypal_account" name="paypal_account_number" type="text" class="form-control" placeholder="{{ isset($shop) ? "XXXXXXXX" : "Enter Your paypal account number (Optional)" }}">
                @error ('paypal_account_number')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              
                <div class="py-3">
                    <button class="btn btn-success btn-sm" type="submit">
                        @if(isset($shop))
                        Update Shop
                        @else
                        Add Shop
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
@endsection

