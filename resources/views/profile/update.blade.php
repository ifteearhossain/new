@extends('layouts.dashboard')

@section('title')
   Update Profile
@endsection

@section('dashboard-active')
  active
@endsection

@section('breadcrumb')

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
    <span class="breadcrumb-item active">Update Profile</span>
  </nav>

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
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
#areacode {
   -o-appearance: none;
   -ms-appearance: none;
   -webkit-appearance: none;
   -moz-appearance: none;
   appearance: none;
}
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-header">
                        <h1>Update Profile</h1>     
                    </div>   
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="py-3">
                                <label for="name">Full Name</label>
                                <input id="name" class="form-control" type="text" name="name" value="{{ Auth::user()->name }}">
                              @error ('name')
                                <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="py-3">
                                <label for="email">Email Address</label>
                                <input id="email" class="form-control" type="text" name="email" value="{{ Auth::user()->email }}" readonly>
                              @error ('email')
                                <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            
                            <div class="py-3">
                                <label for="country_id">Select Country</label>
                               <select name="country_id" class="form-control" id="country_id">
                                   <option value="">-Select Your Country-</option>
                                   @foreach ($countries as $country)
                                       <option value="{{ $country->id }}" {{ (Auth::user()->country_id == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                   @endforeach
                               </select>
                               @error ('country_id')
                                <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="py-3">
                                <label for="state_id">Select State</label>
                               <select name="state_id" class="form-control" id="state_id">
                                   <option value="">-Select Your State-</option>
                               </select>
                               @error ('state_id')
                                <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="py-3">
                                <label for="city_id">Select City</label>
                               <select name="city_id" class="form-control" id="city_id">
                                   <option value="">-Select Your City-</option>
                               </select>
                              @error ('city_id')
                                <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <label for="phone_number">Phone</label>
                            <div class="py-3">
                                
                                    <span style="float:left; border:1px solid rgba(0, 0, 0, 0.15); padding:8.5px; color: #000;" >
                                    <select name="areacode" id="areacode" style="border:none;">
                                       
                                    </select>
                                
                                </span>
                                <input id="phone_number" style=" width:90%; margin-bottom:20px;" class="form-control" type="number" name="phone_number" placeholder="Enter Phone number" value="{{ Auth::user()->phone_number }}">     
                            </div>
                            @error ('phone_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="py-3">
                                <label  for="address">Address</label>
                                <textarea id="address" name="address" cols="30" class="form-control" placeholder="Enter Address">{{ Auth::user()->address }}</textarea>
                              @error ('address')
                                <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="py-3">
                                <label for="zip">Zip</label>
                                <input id="zip" name="zip_code" class="form-control" placeholder="Enter Zip code" value="{{ Auth::user()->zip_code }}">
                              @error ('zip_code')
                                <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            
                            <div class="input-group my-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                <input name="profile_picture" id="upload" type="file" onchange="readURL(this);" class="form-control">
                                <label id="upload-label" for="upload" class="font-weight-light text-muted">Profile Picture</label>
                                <div class="input-group-append">
                                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4"><i style="margin-right:5px; color:#444;" class="fas fa-cloud-upload-alt"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                </div>
                              @error ('profile_picture')
                                <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                
                            <!-- Uploaded image area-->
                            <p class="font-italic text-white text-center">The image uploaded will be rendered inside the box below.</p>
                            <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                           
                            <div class="py-3">
                                <button type="submit" class="btn btn-success">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

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
        $(document).ready(function (){
            $('#country_id').change(function(){
                var country_id = $(this).val();

                // Ajax Default Code Starts 

                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Ajax Default Code Ends    

                // Ajax Request starts

                $.ajax({

                    type: 'POST',
                    url: '/get/state',
                    data: {country_id:country_id},
                    success: function(data)
                    {
                       $("#state_id").html(data);
                    }

                });

                // Ajax Request ends



            });
        });
    </script>
    <script>
        $(document).ready(function (){
            $('#country_id').change(function(){
                var country_id = $(this).val();

                // Ajax Default Code Starts 

                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Ajax Default Code Ends    

                // Ajax Request starts

                $.ajax({

                    type: 'POST',
                    url: '/get/code',
                    data: {country_id:country_id},
                    success: function(data)
                    {
                       $("#areacode").html(data);
                    }

                });

                // Ajax Request ends



            });
        });
    </script>
    <script>
        $(document).ready(function (){
            $('#state_id').change(function(){
                var state_id = $('#state_id').val();

                // Ajax Default Code Starts 

                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Ajax Default Code Ends    

                // Ajax Request starts

                $.ajax({

                    type: 'POST',
                    url: '/get/city',
                    data: {state_id:state_id},
                    success: function(data)
                    {
                       $("#city_id").html(data);
                    }

                });

                // Ajax Request ends

            });
        });
    </script>


@endsection