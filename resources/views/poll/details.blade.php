@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-5">
            <h3>{{$poll->name}}</h3>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <h4>
            Teile den Link mit deinen Freunden, damit sie dir anonym ihre Meinung mitteilen können.
            <p>
                <b style="color:blue;"> grannypinion.de/reply/{{$poll->id}} </b>
            </p>
            </h4>
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;"> 
                    Meine Nachricht
                </div>
                <div class="panel-body">
                    {!! $poll->text !!}
                 </div>
            </div>
        </div>
        @if(!empty( $poll->replies ))
        @foreach( $poll->replies as $reply)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Anonyme Zuschrift</div>
                <div class="panel-body">
                    <div class="col-md-10">
                        {{$reply->text}}
                    </div>

                </div>
             
            </div>
        </div>
           @endforeach
                @endif
    </div>
</div>
@endif
@endsection