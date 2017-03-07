@extends('layouts.master')

@section('content')
Kein Treffer für Vorname:{{$request->firstname}} und Nachname: {{$request->lastname}}.
@endsection