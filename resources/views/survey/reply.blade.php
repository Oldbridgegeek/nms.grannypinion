@extends('layouts.app')

@section('custom-js')
<script src="/js/rating-app.js"></script>
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
                    A friend wants to know your anonymous opinion.
                </div>
                <div class="panel-body">
                    {{$survey->description}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" role="form" method="POST" action="{{route('reply.store')}}">
                {{ csrf_field() }}

                @forelse($survey->questions as $question)
                    @if($question->isStarRating())
                        <div class="form-group">
                            <label>Rate me:</label>
                            <div id="rateYo"></div>
                            <input type="hidden" name="{{$question->id}}">
                            <input type="hidden" id="rating" value="0" name="{{$question->id}}">
                        </div>
                    @elseif($question->isTextInput())
                        <div class="form-group">
                            <label>Say something1:</label>
                            <input type="hidden" name="{{$question->id}}">
                            <input name="{{$question->id}}" type="text" class="form-control">
                        </div>   
                    @elseif($question->isTextArea())
                        <div class="form-group">
                            <label>Say something:</label>
                            <input type="hidden" name="{{$question->id}}">
                            <textarea class="form-control" name="{{$question->id}}"></textarea>
                        </div>   
                    @endif
                     
                @empty

                @endforelse
                

                <button type="submit" class="btn btn-success btn-md"> Reply anonymously </button>
            </form>
        </div>
        
    </div>
</div>
@endsection