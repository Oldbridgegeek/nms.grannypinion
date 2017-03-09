@extends('layouts.app')

@section('content')
	@foreach( $conversation->messages as $message )
		{{$message->body}}
	@endforeach
@endsection