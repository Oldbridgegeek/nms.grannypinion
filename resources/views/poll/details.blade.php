@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-5">
            <h3>{{$poll->name}}</h3>
        </div>
        <div class="col-md-10 col-md-offset-2">
        <h4>
        Teile den Link mit deinen Freunden, damit sie dir anonym ihre Meinung mitteilen können.

        <p>
        <b style="color:blue;"> grannypinion.de/{{$poll->link}} </b>
        </p>

        <div class="col-md-10 col-md-offset-1">
        </h4>
        </div>
    </div>
</div>
@endif
@endsection