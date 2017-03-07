@extends('layouts.master')
@section('title')
Grannypinion
@endsection
@section('content')
@if (Auth::guest())
<div class="row">
    <div class="col-md-6">
        <h3> Registrierung </h3>
        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email"> Deine Email-Adresse </label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="firstname"> Dein Vorname </label>
                <input class="form-control" type="text" name="firstname" id="firstname">
            </div>
            <div class="form-group">
                <label for="lastname"> Dein Nachname </label>
                <input class="form-control" type="text" name="lastname" id="lastname">
            </div>
            <div class="form-group">
                <label for="city"> Wohnort </label>
                <input class="form-control" type="text" name="city" id="city">
            </div>
            <div class="form-group">
                <label for="password"> Dein Passwort </label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="profilePicture"> Profilbild </label>
                <input class="form-control" type="file" name="profilePicture">
            </div>
            <button type="submit" class="btn btn-primary"> Bestätigen </button>
        </form>
    </div>
    <div class="col-md-6">
        <h3> Login </h3>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email"> Deine Email-Adresse </label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password"> Dein Passwort </label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary"> Bestätigen </button>
        </form>
    </div>
</div>
@else
@endif
@endsection