@extends('layouts.app')
@section('custom-js')
<script src="/js/feedbacks-app.js"></script>
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
      <div class="row">
          <div class="col-md-10 col-md-offset-1">

                {{-- FEEDBACK START --}}
                <feedbacks>
                </feedbacks>


              
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