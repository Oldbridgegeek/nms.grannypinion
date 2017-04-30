@extends('layouts.app')
@section('custom-js')
<script src="/js/store.js"></script>
<script src="/js/feedbacks-app.js"></script>
<script src="/js/comment-app.js"></script>

@endsection
@section('content')
<div id="feedbacks-app">
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-md-offset-2">
            <div class="well well-sm user-profile">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="{{$user->getImage()}}"  alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                            {{$user->getFullName()}} </h4>
                        <p>
                            <i class="glyphicon glyphicon-comment"></i> {{ trans('app.feedbacks') }}: @{{feedbacksCount}}
                            <br />
                            <i class="glyphicon glyphicon-question-sign"></i>
                              {{ trans('app.surveys') }}: {{$user->surveys()->count()}}
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>{{ trans('app.registered') }}: {{$user->created_at->diffForHumans() }}</p>
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
</div>


@if(Auth::check())
  <div class="container" >
      <div class="row">
          <div class="col-md-10 col-md-offset-1">

                {{-- FEEDBACK START --}}
                <feedbacks>
                </feedbacks>
              
                <br><br>
                <div class="row" v-if="feedbacksCount == 0">
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
</div>
@endsection

@section('customJS')
  <script src="/js/feedbacks-app.js"></script>
@endsection