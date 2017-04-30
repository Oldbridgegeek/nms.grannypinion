@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
              @if(isset($users))
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
              @else
                <div class="jumbotron text-xs-center">
                  <h1 class="display-3">Sorry!</h1>
                  <p class="lead"><strong>Your request: {{$request}}</strong> gave no results.</p>
                  <hr>
                  <p>
                    Having trouble? <a href="/">Contact us</a>
                  </p>
                  <p class="lead">
                    <a class="btn btn-primary btn-sm" href="{{Auth::check() ? Auth::user()->id : ''}}" role="button">Continue to homepage</a>
                  </p>
                </div>            
              @endif  
            </div>
        </div>
    </div>
    

@endsection