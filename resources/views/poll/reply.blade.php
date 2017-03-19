@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @if(Auth::check())
        <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;"> 
                    Ein Freund wünscht sich deine anonyme Meinung
                </div>
                <div class="panel-body">
                    {!! $poll->text !!}
                 </div>
        </div>
        </div>

        <div class="col-md-6 col-md-offset-3" style="margin-bottom:2em;">      
            <form class="form-horizontal" role="form" method="POST" action="{{route('reply.store')}}" style="margin-top:2em;">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="poll_id" id="poll_id" value="{{$poll->id}}">
                 <div class="form-group">
                        <label for="feedback" class="control-label">Deine Meinung</label>
                        <textarea class="form-control" rows="10" name="text" id="text"></textarea>
                    </div>
                <button type="submit" class="btn btn-success btn-md" style="display: block; width: 100%;"> Anonym antworten </button>
            </form>

        </div>
        

    </div>
    @else
    <div class="col-md-10 col-md-offset-2" style="margin-bottom:2em;">
        <div class="row">
            
    </div>
    <div class="col-md-10 col-md-offset-2">
        <form class="form-horizontal" role="form" method="POST" action="/">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" id="user_id" value="0">
            <input type="hidden" name="poll_id" id="poll_id" value="{{$poll->id}}">
            <div class="form-group">
                        <label for="feedback" class="control-label">Deine Meinung</label>
                        <textarea class="form-control" rows="10" name="text" id="text"></textarea>
                    </div>
            
        </form>
    </div>
    @endif
</div>
@endsection