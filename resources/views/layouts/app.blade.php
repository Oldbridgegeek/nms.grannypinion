<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Scripts -->
        <script>
        window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        ]) !!};
        </script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top" style="background-color:#042551;">
                <div class="container">
                <div class="col-md-5">
                    <div class="navbar-header">
                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    </div>
                    @if(!Auth::guest())
                    <div class="col-md-5">
                        <form class="navbar-form" role="search" method="GET" action="{{ route('user.search') }} " >
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Suche" name="firstName" id="firstName" style="text-align:center;">
                                <input type="hidden" class="form-control" name="lastname" id="lastname" value="" style="text-align:center;">
                            </div>
                        </form>
                    </div>
                    @endif
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('user.show' , ['user' => Auth::user()])}}"> Mein Profil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            @yield('content')
        </div>
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
        <script>
            var visible = true;
            document.getElementById('feedbackTextOnly').onclick = function(event){
                if(visible == true){
                    document.getElementById('starRating').style.visibility = 'hidden';
                    document.getElementById('feedbackTextOnly').innerHTML = "Ich möchte eine Feedback Hilfe";
                    visible = false;
                    var children = document.getElementsByClassName('form-control');
                    for (var i=0; i<children.length ; i++){
                        var ratingChild = children[i];
                        ratingChild.value = "";
                    }
                }
                else {
                    document.getElementById('starRating').style.visibility = 'visible';
                    document.getElementById('feedbackTextOnly').innerHTML = "Ich möchte nur einen Feedback Text schreiben.";
                    visible = true;
                }
            }

            function toggleCheckbox(element, idStars)
            {
                if(element.checked == true){
                    document.getElementById(idStars).disabled = true;
                    document.getElementById(idStars).value = "";
                }
                if(element.checked == false){
                    document.getElementById(idStars).disabled = false;
                }
            }
        </script>
    </body>
</html>