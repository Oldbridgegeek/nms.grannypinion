<?php
use Carbon\Carbon;
?>
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
        
          {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        <link rel="stylesheet" href="/css/custom.css">
        <link rel="stylesheet" href="/css/comment.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- jQuery -->
        {{-- <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script> --}}

        <!-- Fonts -->
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto">
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">

        

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
        <!-- Latest compiled and minified JavaScript -->
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script> --}}
        <!-- Scripts -->
        
        <script src="/js/custom.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.js"></script> --}}
        {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vuex/2.3.1/vuex.js"></script> --}}
        {{-- <script src="https://unpkg.com/vue"></script> --}}
        {{-- @yield('custom-js') --}}


        <script>
        window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        ]) !!};
        </script>

    </head>
    <body>

        @if(Auth::check() && !Auth::user()->isEmailConfirmed())
            <div class="check-email">
                {{ trans('app.confirm_email') }}
            </div>
            @else
        @endif
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top" style="background-color:#303F9F;">
                <div class="container">
                <div class="col-md-5">
                    <div class="navbar-header">
                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}" style="color:#fbfbfb; font-family: 'Dancing Script', cursive; font-size:2em;">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    </div>
                    @if(!Auth::guest())
                    <div class="col-md-3">
                        <form class="navbar-form" role="search" method="GET" action="{{ route('user.search') }} " >
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="{{ trans('app.search') }}" name="name" id="name" style="text-align:center;border-radius:15px;">
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
                            @if(App::getLocale() == 'en')
                                <li><a href="{{ url('lang/de') }}"><img src="/img/de.svg" width="20"></a></li>
                            @else
                                <li><a href="{{ url('lang/en') }}"><img src="/img/gb.png" width="20"></a></li>
                            @endif
                            
                            
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                            <li><a href="{{ route('login') }}">{{ trans('auth.log_in') }}</a></li>
                            <li><a href="{{ route('register') }}">{{ trans('auth.sign_up') }}</a></li>
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('user.show' , ['user' => Auth::user()])}}">{{ trans('app.my_profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('survey.index') }}">{{ trans('app.my_surveys') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ trans('auth.log_out') }}
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
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
        
    </body>
    <footer>
    <div class="container">
        <div class="row" style="margin-top:4em;">
          <div class="col-sm-8">
            <ul class="list-inline social">
              <li>{{ trans('app.we_are_strong') }}</li>
              <li><a href="https://www.facebook.com/Grannypinion-284201705342315/"><i class="fa fa-facebook"></i></a></li>
              <li><a href="https://www.instagram.com/grannypinion/"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
          
          <div class="col-sm-4 text-right">
            <p><small>{{ trans('app.copyright') }}<br>
                {{ trans('app.created_by') }} <a href="http://eneswitwit.com">Enes Witwit</a></small></p>
          </div>
        </div>
        </div>
    </footer>

    <script src="/js/app.js"></script>
    @yield('customJS')
    <!-- Latest compiled and minified JavaScript -->
        
</html>