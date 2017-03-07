@extends('layouts.master')
@section('title')
Grannypinion - Meine Nachrichten
@endsection
@if (!Auth::guest())
@section('content')
@foreach( $messages as $message )
{{$message->text}}
@endforeach
@endsection
@endif