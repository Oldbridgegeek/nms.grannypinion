@extends('layouts.app')

@section('content')
    @foreach ($users as $user)
    <li class="list-group-item">
        <div class="row" style="margin-top:0em;">
            <div class="col-md-12" style="margin-top:0em;">
                <div class="post">
                    <div class="col-md-8">
                        <h3>
                            {{$user->firstname}} {{$user->lastname}}
                        </h3>
                        <a href="/{{$user->id}}">
                            <button class="btnnew lgnew ghost">
                                Profil sehen
                            </button>
                        </a>
                        <a href="/{{$user->id}}/feedback/create">
                            <button class="btnnew lgnew ghost">
                                Bewerten
                            </button>
                        </a>
                        <a href="/{{$user->id}}/message">
                            <button class="btnnew lgnew ghost" disabled style="color:grey;">
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