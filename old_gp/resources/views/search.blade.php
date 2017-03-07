@extends('layouts.master')
@section('title')
Grannypinion - Suche
@endsection
@if (!Auth::guest())
@section('content')
@foreach ($users as $user)
<li class="list-group-item">
    <div class="row" style="margin-top:0em;">
        <div class="col-md-12" style="margin-top:0em;">
            <div class="post">
                <div class="col-md-8">
                    <h3>
                    Name: {{$user->firstname}} {{$user->lastname}}
                    </h3>
                    <a href="/{{$user->id}}">
                        <button class="btnnew lgnew ghost">
                        Profil sehen
                        </button>
                    </a>
                    <a href="/{{$user->id}}/feedback">
                        <button class="btnnew lgnew ghost">
                        Feedback
                        </button>
                    </a>
                    <a href="/{{$user->id}}/message">
                        <button class="btnnew lgnew ghost">
                        Anonyme Nachricht schicken
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</li>
@endforeach
@endsection
@endif