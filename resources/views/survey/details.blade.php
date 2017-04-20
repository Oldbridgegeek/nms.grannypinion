@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-5">
            <h3>{{$survey->name}}</h3>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <h4>
            Share the link with your friends so they can give you their anonymous opinion.

            <p>
                <b style="color:blue;"> {{env('APP_URL')}}/reply/{{$survey->id}} </b>
            </p>
            </h4>
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
                <div class="panel-heading" style="text-align: center;">Anonymous replies ({{$replies[0]->created_at->diffForHumans()}})</div>
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