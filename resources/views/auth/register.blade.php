@extends('layouts.frontend')

@section('content')

  {{-- Default Laravel Registration Starts  --}}

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

   {{-- Default Laravel Registration Ends --}}



            {{--      Custom Login Starts      --}}

            <div class="ps-page--my-account">
                <div class="ps-breadcrumb">
                    <div class="container">
                        <ul class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li>My account</li>
                        </ul>
                    </div>
                </div>
                <div class="ps-my-account">
                    <div class="container">
                        <form class="ps-form--account ps-tab-root" method="POST" action="{{ route('login') }}">
                            @csrf
                            <ul class="ps-tab-list">
                                <li><a href="#sign-in">Login</a></li>
                                <li class="active"><a href="#register">Register</a></li>
                            </ul>
                            <div class="ps-tabs">
                                <div class="ps-tab" id="sign-in">
                                    <div class="ps-form__content">
                                        <h5>Log In Your Account</h5>
                                        <div class="form-group">
                                            <input  type="text"  placeholder="Enter email address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-forgot">
                                            <input type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" >
                                            @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                        
                                            <div class="form-check ps-checkbox">
                                                <input class="form-control" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group submtit">
                                            <button type="submit" class="ps-btn ps-btn--fullwidth">Login</button>
                                        </div>
                                    </div>
                                    <div class="ps-form__footer">
                                        <p>Connect with:</p>
                                        <ul class="ps-list--social">
                                            <li><a class="facebook" href="{{ route('social.oauth', 'facebook') }}"><i class="fa fa-facebook"></i></a></li>
                                            <li><a class="google" href="{{ route('social.oauth', 'google') }}"><i class="fa fa-google-plus"></i></a></li>
                                            {{-- <li><a class="twitter" href="{{ route('social.oauth', 'twitter') }}"><i class="fa fa-twitter"></i></a></li> --}}
                                        </ul>
                                    </div>
                                </form>
                                </div>



                                
                                {{-- Custom Registration Starts --}}
                                
                                <div class="ps-tab active" id="register">
                                    <div class="ps-form__content">
                                        <h5>Register An Account</h5>
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf


                                        <div class="form-group">
                                            <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus type="text" placeholder="Full name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email address">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input placeholder="Confirm password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                        <div class="form-group submtit">
                                            <button class="ps-btn ps-btn--fullwidth" type="submit">Register</button>
                                        </div>
                                    </div>
                                    <div class="ps-form__footer">
                                        <p>Connect with:</p>
                                        <ul class="ps-list--social">
                                            <li><a class="facebook" href="{{ route('social.oauth', 'facebook') }}"><i class="fa fa-facebook"></i></a></li>
                                            <li><a class="google" href="{{ route('social.oauth', 'google') }}"><i class="fa fa-google-plus"></i></a></li>
                                            {{-- <li><a class="twitter" href="{{ route('social.oauth', 'twitter') }}"><i class="fa fa-twitter"></i></a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

@endsection
