@extends('layouts.app')
@section('content')
@if(true)
<style>
  div.user-image img{
    width: 100%;
  }
  body
  {
    background: #e9ebee;
  }

  div.user-profile{
    background: #fff;
    padding: 25px 0;
    overflow: hidden;
  }
  .navbar
  {
    margin-bottom: 10px;
  }
  div.user-profile h2{
    margin-top: 0px;
  }
  .user-stats li
  {
    list-style-type: none;
  }
  .hidden-feedback
  {
    background: #f3f3f3;
  }
  
  
</style>
<div class="container">
  <div class="row">
      <div class="col-md-10 col-md-offset-1">
          <div class="user-profile">
            <div class="col-md-3 user-image">
              <img src="{{$user->getImage()}}" class="img-rounded"/>
            </div>
            <div class="col-md-7">
              <h2> {{$user->firstname}} {{$user->lastname}} </h2>
                <div class="user-stats">
                  <ul>
                    <li><i class="glyphicon glyphicon-comment"></i> 
                    Feedbacks: {{'4'}}</li>
                  </ul>
                </div>
                @if($user->isAuthor())
                  @include('user.profile.forAuthor')
                @elseif($user->authorizedUser())
                    @include('user.profile.forAuthorizedPerson')
                 @else
                    @include('user.profile.forGuest')    
                @endif
            </div> 
          </div>
      </div>
  </div>
</div>

@if(Auth::check())
  <div class="container">
      <div class="row">
          <div class="col-md-10 col-md-offset-1">
          @forelse($user->feedbacks as $feedback)

              @if($user->isAuthor())
                {{-- FEEDBACK START --}}
                <div data-id="{{$feedback->id}}" class="panel panel-default feedbacks <?= (!$feedback->isPublic()) ? "hidden-feedback" : "public-feedback";?>" style="overflow:hidden;">
                  <div class="panel-heading">{{ trans('app.feedback_title') }} ({{$feedback->created_at->diffForHumans()}})

                  @if(Auth::user()->id == $feedback->user->id)
                    <ul class="feedback-settings">
                      <li class="toggle-status" data-feedback-id="{{$feedback->id}}">
                        @if($feedback->isPublic())
                            <i class="glyphicon glyphicon-eye-close"></i>
                            {{ trans('app.make_private') }}
                        @else
                            <i class="glyphicon glyphicon-eye-open"></i>
                            {{ trans('app.make_public') }}
                        @endif
                        
                      </li>
                      <li class="delete-feedback">
                        <i class="glyphicon glyphicon-remove"></i>
                      </li>
                    </ul>                
                  @endif

                    {{-- <div class="clearfix"></div> --}}
                  </div>
                  <div class="panel-body">
                    <div class="feedback-content">
                        {{$feedback->text}}
                    </div>
                    <hr>
                    <div class="ui comments">
                      @each('user._comment', $feedback->comments, 'comment','user._no_comments')
                      <br> 
                      <form class="ui reply form " id="comment-form">
                        <div class="field">
                          <textarea class="form-control"></textarea>
                        </div>
                        <br>
                        <div class="btn btn-success add-reply">
                          <i class="glyphicon glyphicon-comment"></i> Add Reply
                        </div>
                        <div class="btn cancel-reply">
                          <a href="#"><span class="comment-username"></span> </a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- FEEDBACK END --}}
              @elseif($user->authorizedUser())
                @if($feedback->isPublic())
                  {{-- FEEDBACK START --}}
                  <div data-id="{{$feedback->id}}" class="panel panel-default feedbacks" style="overflow:hidden;">
                  <div class="panel-heading">{{ trans('app.feedback_title') }} ({{$feedback->created_at->diffForHumans()}})

                  @if(Auth::user()->id == $feedback->user->id)
                    <ul class="feedback-settings">
                      <li class="toggle-status" data-feedback-id="{{$feedback->id}}">
                        @if($feedback->isPublic())
                            <i class="glyphicon glyphicon-eye-close"></i>
                            {{ trans('app.make_private') }}
                        @else
                            <i class="glyphicon glyphicon-eye-open"></i>
                            {{ trans('app.make_public') }}
                        @endif
                        
                      </li>
                      <li class="delete-feedback">
                        <i class="glyphicon glyphicon-remove"></i>
                      </li>
                    </ul>                
                  @endif

                    {{-- <div class="clearfix"></div> --}}
                  </div>
                  <div class="panel-body">
                    <div class="feedback-content">
                        {{$feedback->text}}
                    </div>
                    <hr>
                    <div class="ui comments">
                      @each('user._comment', $feedback->comments, 'comment','user._no_comments')
                      <br> 
                      <form class="ui reply form " id="comment-form">
                        <div class="field">
                          <textarea class="form-control"></textarea>
                        </div>
                        <br>
                        <div class="btn btn-success add-reply">
                          <i class="glyphicon glyphicon-comment"></i> Add Reply
                        </div>
                        <div class="btn cancel-reply">
                          <a href="#"><span class="comment-username"></span> </a>
                        </div>
                      </form>
                    </div>
                  </div>
                  </div>
                  {{-- FEEDBACK END --}}
                @endif
              @endif
          @empty
            {{ trans('app.no_feedbacks') }}
          @endforelse
              
          </div>
      </div>
  </div>
@else
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
      <br>
        <p class="alert alert-danger">
          {{ trans('app.not_authorized_to_see') }}
        </p>
      </div>
    </div>
  </div>
@endif

@endif


@endsection