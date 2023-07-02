<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pixello</title>
        <link rel="stylesheet" href="{{asset('/web/style.css')}}">
        <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <style>
            .masthead {
                    height: 100vh;
                    min-height: 500px;
                    background-image: url('https://source.unsplash.com/BtbjCFUvBXs/1920x1080');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    }
        </style>
    </head>
    <body class="antialiased">
            <nav class="position-fixed w-100  navbar navbar-expand-sm bg-light">
                  <div class="container ">
                    <a class="navbar-brand" href="/">
                        <img src="/favicon.png" alt="Pixello" width="35">
                    </a>
                    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="w-75 d-flex justify-content-end collapse navbar-collapse" id="collapsibleNavId">
                        <ul class=" navbar-nav  mt-2 mt-lg-0">
                            
                                
                            @auth
                            <li class="nav-item">
                                <a class="nav-link" href="/home">Inicio</a>
                            </li>
                            @else
                                @if(Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @endif

                                @if(Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @endauth
                           
                        </ul>
                    </div>
              </div>
            </nav>
            
            <header class="masthead">
                <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-md-10 text-center">
                    <h1 class="fw-light">Pixello</h1>
                    <p class="lead ">
                        Captura momentos inolvidables y compártelos con el mundo. En Pixello, puedes subir tus fotos favoritas y descubrir un universo de creatividad visual. Explora una amplia variedad de imágenes, desde paisajes deslumbrantes hasta retratos impresionantes.
                    </p>
                    </div>
                </div>
                </div>
            </header>
          
      
       
    </body>
</html>
