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
    
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        @forelse($user->feedbacks as $feedback)
            {{-- FEEDBACK START --}}
            <div data-id="{{$feedback->id}}" class="panel panel-default feedbacks" style="overflow:hidden;">
              <div class="panel-heading">{{ trans('app.feedback_title') }} ({{$feedback->created_at->diffForHumans()}})
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
        @empty
          No feedbacks left.
        @endforelse
            
        </div>
    </div>
</div>

@endif


@endsection