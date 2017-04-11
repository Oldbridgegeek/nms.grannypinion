@extends('layouts.app')
@section('content')
@if( $user->id == Auth::user()->id or $user->public )
<div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-2" style="border-style: solid;border-width: 0px;">
                <div class="row" style="border-style: solid; border-width: 0px; box-shadow: 1px 1px grey; background-color: #fdfdfd;">
                    <img src="{{$user->getImage()}}" style="width:150px;height:150px; float:left; border-radius:0%; margin-right:25px"></img>
                    <h2> {{$user->firstname}} {{$user->lastname}} </h2>
                    @if($user->id == Auth::user()->id)
                        <a href="{{route('user.setting',['user' => Auth::user()])}}" > <button class="btn btn-primary btn-md">{{ trans('app.settings') }}</button></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=grannypinion.de/{{Auth::user()->id}}/feedback/create&display=popup"> <button class="btn btn-primary btn-md"> {{ trans('app.ask_facebook') }} </button> </a>
                        <p style="margin-top:1em;">{{ trans('app.share_facebook') }}: <b style="color:blue;"> www.grannypinion.de/{{Auth::user()->id}}/feedback/create </b></p>
                    @else
                        <a href="/{{$user->id}}/feedback/create">
                            <button class="btn btn-primary btn-md">
                            Feedback
                            </button>
                        </a>
                        <a href="/{{$user->id}}/message">
                            <button class="btn btn-primary btn-md disabled">
                            Anonymous Message
                            </button>
                        </a>
                    @endif
                </div>
            </div>
            </div>
        </div>
</div>
{{-- </div> --}}
<style>
    div.feedback-content
    {
        margin: 15px 0px;
        font-size: 20px;
    }
    div.feedbacks
    {
        margin-top: 20px;
    }
    ul.feedback-settings
    {
      float:right;
      list-style-type: none;
      overflow: hidden;
    }
    ul.feedback-settings li
    {
      display: inline-block;
      cursor: pointer;
    }
    ul.feedback-settings li:nth-child(2)
    {
      margin-left: 20px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        @forelse($user->feedbacks as $feedback)
            {{-- FEEDBACK START --}}
            <div class="panel panel-default feedbacks" style="overflow:hidden;">
              <div class="panel-heading">{{ trans('app.feedback_title') }} ({{$feedback->created_at->diffForHumans()}})
                <ul class="feedback-settings">
                  <li>
                    <i class="glyphicon glyphicon-eye-open"></i>
                    Make Public
                  </li>
                  <li>
                    <i class="glyphicon glyphicon-remove"></i>
                  </li>
                </ul>
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
                  <form class="ui reply form">
                    <div class="field">
                      <textarea class="form-control"></textarea>
                    </div>
                    <br>
                    <div class="btn btn-success">
                      <i class="glyphicon glyphicon-comment"></i> Add Reply
                    </div>
                  </form>
                </div>
              </div>
            </div>
            {{-- FEEDBACK END --}}
        @empty
          No feedbacks left.
        @endforelse
            
        </div>
    </div>
</div>

@endif
@endsection