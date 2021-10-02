<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                font-size: 18px;
            }

            .title {
                font-size: 90px;
            }

            .image-color {
                color:#223a70;
            }

            .image-color-backgroud {
                background-color: #223a70;
            }

        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row d-flex align-items-center">
                <div class="col-sm-4 pl-5 image-color-backgroud">
                    <img src="{{ asset('storage/images/violin.jpg') }}" alt="violin-image" class="vh-100">    
                </div>
                <div class="col-sm-8 mt-3 pl-5">
                    <div class="title mb-5">
                        UNIZ<span class="image-color">ON</span>
                    </div>

                    <div class="mb-5">
                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-outline-dark">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-dark mr-2">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-dark">Register</a>
                            @endif
                        @endauth
                    </div>

                    <div class="mb-4">
                        In this COVID situation, a lot of musiciana are apart though we are eager to play together.
                        UNIZON is a community for those who want to connect with other musicians around the world.
                    </div>
                    
                    <div>
                        <div class="mb-2">
                            In UNIZON, you can...
                        </div>
                        <div>
                            1. Plan online ensemble and look for participants. 
                        </div>
                        <div>
                            2. Share your knowledge about classical mucic or instruments.
                        </div>
                        <div>
                            3. Ask questions about classical mucic or playing instruments.
                        </div>
                    </div>
                </div>
            </div>     
        </div>
    </body>
</html>
