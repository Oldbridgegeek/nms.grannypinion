@extends('layouts.app')
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
        <div class="col-md-8 col-md-offset-2" style="margin-bottom:2em;">
            <form class="form-horizontal" role="form" method="POST" action="{{route('reply.store')}}" style="margin-top:2em;">
                {{ csrf_field() }}
                @if(Auth::check())
                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                @else
                <input type="hidden" name="user_id" id="user_id" value="0">
                @endif
                <input type="hidden" name="poll_id" id="poll_id" value="{{$survey->id}}">
                <div class="form-group">
                    <textarea class="form-control" rows="10" name="text" id="text" placeholder="Be honest. You'll stay anonymous"></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-md" style="display: block; width: 100%;"> Reply anonymously </button>
            </form>
        </div>
        
    </div>
</div>
@endsection