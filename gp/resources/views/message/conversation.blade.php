@extends('layouts.app')
@if (!Auth::guest())
@section('content')
@foreach( $messages as $message )
{{$message->text}}
@endforeach
@endsection
@endif