@extends('layouts.app')
@section('custom-js')
<script src="/js/comment-app.js"></script>
@endsection
@section('content')
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
                    Feedbacks: {{$feedbacksCount}}</li>
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
  <div class="container" id="commentaries-app">
  <feedback>  </feedback>
      <div class="row">
          <div class="col-md-10 col-md-offset-1">

                {{-- FEEDBACK START --}}
                <div class="panel panel-default feedbacks" v-for="feedback in feedbacks">
                  <div class="panel-heading">@{{feedback.title}} (@{{feedback.date}})

                    <ul class="feedback-settings">
                      <li class="toggle-status" v-if="feedback.isAuthor">
                            <span v-if="feedback.isStatusPublic">
                              <i class="glyphicon glyphicon-eye-close"></i>
                              Make private
                            </span>
                            <span v-else>
                              <i class="glyphicon glyphicon-eye-open"></i>
                              Make public
                            </span>
                      </li>
                      <li class="delete-feedback">
                        <i class="glyphicon glyphicon-remove"></i>
                      </li>
                    </ul>                

                    {{-- <div class="clearfix"></div> --}}
                  </div>
                  <div class="panel-body">
                    <div class="feedback-content">
                        @{{feedback.content}}
                    </div>
                    <hr>
                    <div class="ui comments">
                      {{-- @each('user._comment', $feedback->comments, 'comment','user._no_comments') --}}
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


              
                <br><br>
                <div class="row">
                  <div class="col-md-12">
                    <div class="alert alert-info">
                      {{ trans('app.no_feedbacks') }}
                    </div>
                  </div>
                </div>
              
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

@endsection