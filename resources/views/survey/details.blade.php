@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-5">
            <h3>{{$survey->name}}</h3>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <h3>
            {{ trans('app.share_the_link') }}
            <br><br>
            <div>
                <input type="text" class="form-control" value="{{env('APP_URL')}}/reply/{{$survey->id}}" disabled style="width: 50%; float:left;">

                <div class="btn-group" style="margin-left: 15px;">
                    <button type="button" class="btn btn-primary">
                        {{ trans('app.share') }}!</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span><span class="sr-only">Social</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="https://twitter.com/intent/tweet?text={{trans('app.twitter')}} {{env('APP_URL')}}/{{Auth::user()->id}}/reply/{{$survey->id}}">Twitter</a></li>
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{env('APP_URL')}}/reply/{{$survey->id}}&display=popup">Facebook</a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>

            </h3>
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;"> 
                    {{$survey->title}}
                </div>
                <div class="panel-body">
                    {{ $survey->description }}
                 </div>
            </div>
        </div>
        @forelse($answers as $replies)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">{{ trans('app.anonymous_reply') }} ({{$replies[0]->created_at->diffForHumans()}})</div>
                <div class="panel-body">
                    @forelse($replies as $reply)
                        <div class="col-md-10">

                            @if($reply->question->isStarRating())
                                @include('survey.replies.star')
                            @elseif($reply->question->isTextInput())
                                @include('survey.replies.textinput')
                            @elseif($reply->question->isTextArea())
                                @include('survey.replies.textarea')
                            @endif
                            
                        </div>
                    @empty

                    @endforelse
                    
                </div>
            </div>
        </div> 
        @empty

        @endforelse
    </div>
</div>
@endif
@endsection

