@extends('layouts.app')

@section('content')
<style>
    @import url(http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);
    .snip1578 {
      font-family: 'Open Sans', Arial, sans-serif;
      position: relative;
      display: inline-block;
      margin: 40px 8px;
      min-width: 230px;
      max-width: 315px;
      width: 100%;
      color: #000;
      text-align: left;
      font-size: 16px;
      background: #e9e9e9;
      border-radius: 5px;
    }

    .snip1578 *,
    .snip1578:before,
    .snip1578:after {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      -webkit-transition: all 0.4s ease;
      transition: all 0.4s ease;
    }

    .snip1578 img {
      max-width: 35%;
      margin-top: -15px;
      margin-left: 60%;
      margin-bottom: 15px;
      backface-visibility: hidden;
      vertical-align: top;
      border-radius: 5px;
    }

    .snip1578 figcaption {
      position: absolute;
      top: 0;
      right: 40%;
      left: 0;
      bottom: 0;
      padding: 15px;
    }

    .snip1578 h3 {
      margin: 0;
      font-size: 1.1em;
      font-weight: normal;
    }

    .snip1578 .icons {
      font-size: 1.6rem;
    }

    .snip1578 .icons a {
      color: #ccc;
    }

    .snip1578 .icons a:hover {
      color: #2980b9;
    }


    /* Demo purposes only */
/*
    body {
      background-color: #212121;
      text-align: center;
    }*/
</style>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach ($users as $user)
                    @if(auth()->check() && $user->id != auth()->user()->id)
        
                    <figure class="snip1578">
                    <img src="{{$user->getImage()}}" />
                      <figcaption>
                        <h3>{{$user->getFullName()}}</h3>
                        <br>
                        <div class="icons">
                          <a title="{{ trans('app.profile') }}" href="/{{$user->id}}"><i class="glyphicon glyphicon-user"></i></a>
                          <a title="{{ trans('app.feedback_title') }}" href="/{{$user->id}}/feedback/create"> <i class="glyphicon glyphicon-comment"></i></a>
                          <a title="{{ trans('app.anonymous_message') }}" href="/room/create/{{$user->id}}"> <i class="glyphicon glyphicon-envelope"></i></a>
                        </div>
                      </figcaption>
                    </figure>
                        
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    

@endsection