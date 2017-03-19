@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Meine Meinungsumfragen</div>
                @if(!empty( $user->polls ))
                @foreach( $user->polls as $poll)
                <div class="panel-body">
                    <div class="col-md-5">
                        {{$poll->name}}
                    </div>
                    <div class="col-md-5">
                        {{$poll->created_at->format('d.m.Y')}}
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('poll.show', ['poll' => $poll] )}}" class="btn btn-primary btn-md"> Details </a>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <a href="{{route('poll.create')}}" class="btn btn-success btn-md" style="display: block; width: 100%;"> Meinungsumfrage erstellen </a>
        </div>
    </div>
</div>
@endif
@endsection