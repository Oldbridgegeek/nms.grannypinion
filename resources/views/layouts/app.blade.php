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
        <!-- Scripts -->
        <script
          src="https://code.jquery.com/jquery-1.12.4.min.js"
          integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
          crossorigin="anonymous"></script>
        <script src="/js/rate.js"></script>
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
        <script src="/js/custom.js"></script>

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
            <nav id="main-nav" class="navbar navbar-default navbar-static-top" style="background-color:#4527a0;">
                <div class="container">
                <div class="col-md-5">
                    <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button
                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}" style="color:#fbfbfb; font-family: 'Dancing Script', cursive; font-size:2em;">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    </div>
                    @if(!Auth::guest())
                    <div class="col-md-3 col-sm-3 hidden-xs">
                        <form class="navbar-form" role="search" method="GET" action="{{ route('user.search') }} " >
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="{{ trans('app.search') }}" name="name" id="name" style="text-align:center;border-radius:15px;">
                            </div>
                        </form>
                    </div>
                    @endif
                    {{-- <div class="collapse navbar-collapse" id="app-navbar-collapse"> --}}
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            
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
                                        <a href="{{ route('user.show' , ['user' => Auth::user()])}}"><i class="glyphicon glyphicon-user"></i> {{ trans('app.my_profile') }}
                                        </a>
                                    </li>
                                    <li>

                                        <a href="{{ route('survey.index') }}"><i class="glyphicon glyphicon-question-sign"></i> {{ trans('app.my_surveys') }}</a>
                                    </li>
                                    <li>
                                        <a href="/messages"><i class="glyphicon glyphicon-comment"></i> {{ trans('app.my_messages') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('user.setting')}}"><i class="glyphicon glyphicon-tasks"></i> {{ trans('app.settings') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="glyphicon glyphicon-off"></i> 
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
            @if (session('status'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
        </div>
            @yield('content')
        
    {{-- <footer>
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
    </footer> --}}
    <style>
        #footer.subsection {
            position: fixed;
            bottom: 0px;
            width: 100%;
            text-align: center;
            opacity: .6;
            padding-top:1rem;
            /*padding-bottom:0.9rem;*/
            background: #eee;
            color: #000;
            text-align: center;
            height: 30px;
        }

        #footer small {
            font-weight: 300
        }

        #footer p {
            font-weight: 300;
            font-size: 1.2rem;
            letter-spacing: 0.02rem;
            line-height: 1.72rem;
            margin: 0px 0px 1.72rem 0px
        }
        .social_icons ul, .social_icons ul li {
            display: inline-block;
            list-style: none;
            padding: 0;
            height: 2rem;
        }

        .social_icon{
            font-size:1rem;
            line-height:1rem;
            opacity:0.5;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .social_icon:hover {
            cursor:pointer;
            opacity:1;
        }

        .social_icons ul, .social_icons ul li {
            display: inline-block;
            list-style: none;
            padding: 0;
            height:2rem;
        }

        .social_icons ul li {
            margin-right: 0.7rem;
            margin-left: 0.7rem;
        }

        .social_icons ul li:first-child {
            margin-left:0;
        }

        .social_icons ul li:last-child {
            margin-right:0;
        }

        .social_icons ul li {
            float:left;
        }

        .social_icons_container {
            position: relative;
            width:100%;
            z-index: 10;
        }
    </style>
    <section id="footer" class="subsection">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 align-center">
                <p><small>Copyright © {{date('Y')}} Grannypinion, Made with <span style="color: red;">❤</span> by 
                <a href="http://eneswitwit.com">Enes Witwit</a></small></p> 
                </div>
            </div>              
        </div>
    </section><!-- //More info -->

    <script src="/js/app.js"></script>
    @yield('customJS')
    <!-- Latest compiled and minified JavaScript -->
    </body>
</html>