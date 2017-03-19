@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-2">
        <h2> Danke für deine Mühe.</h2>
        <h3> Falls du auch interessiert bist zu erfahren, was Deine Freunde und Bekannte
        wirklich über dich denken, dann melde Dich kostenlos bei uns an.</h3>
        <a href={{ route('welcome')}}> <button class="btn btn-success btn-block"> Anmelden </button> </a>
    </div>
</div>
@endsection