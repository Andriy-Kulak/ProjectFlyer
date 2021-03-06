<!DOCTYPE html>
<html lang="'en">

<head>
    <meta charset="UTF-8">
    <title>Project Flyer</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="{{URL::asset('/css/libs.css')}}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
    <link rel="stylesheet" href="{{URL::asset('/css/lity.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('/css/app.css')}}" type="text/css">

</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed"
                        data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Project Flyer</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Home</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/contactus">Contact</a></li>
                </ul>

                <!-- displays Hello User message... $signedIn = Auth::check() !-->
                @if ($signedIn)
                    <p class="navbar-text navbar-right">
                        Hello, {{$user->name }}
                    </p>
                @endif

            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    @yield('scripts.footer')



    <!-- sweetalert js library !-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="/js/libs.js"></script>
    <script src="/js/lity.js"></script>
    @include('flash')

</body>

</html>

