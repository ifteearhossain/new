<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ekomalls</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="icon" href="{{ asset('dashboard_assets/img/apple-touch-icon-57x57.png') }}">

        <!-- Styles -->
        <style>
            html, body {
                /* background-color: #f1f1f1; */
                background-image: linear-gradient(to right top, #000000, #2c2c2c, #545454, #808080, #afafaf, #c6c6c6, #dddddd, #f4f4f4, #f7f7f7, #f9f9f9, #fcfcfc, #ffffff);
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif --}}
                    @endauth
                </div>
            @endif

            <div class="content">
              <div class="">
                  <img src="{{ asset('dashboard_assets/img/logo.jpg') }}" alt="Not found" width="300">
              </div>
                <div class="title m-b-md">

                    Ekomalls
                </div>

                <div class="links">
                  <a href="#">Development in Progress .... Something Cool is coming on your way ;)</a>
                </div>
            </div>
        </div>
    </body>
</html>
