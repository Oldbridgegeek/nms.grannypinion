@extends('layouts.master')
@section('title')
Grannypinion - Meine Nachrichten
@endsection
@if (!Auth::guest())
@section('content')
Conversations I started.
<ul class="list-group">
    @foreach( $conversationsStarted as $convStarted )
    <li><a href="/conversation/{{$convStarted->id}}"> {{$convStarted->id}} </a></li>
    @endforeach
    Conversations I did not started.
    @foreach( $conversationsReceived as $convReceived )
    <li><a href="/conversation/{{$convStarted->id}}"> {{$convStarted->id}} </a></li>
    @endforeach
</ul>
@endsection
@endif