@extends('layouts.app')

@section('content')
    @foreach ($users as $user)
    <div class="container">
    <li class="list-group-item" style="margin-top:2em;box-shadow: 2px 2px grey;">
        <div class="row" style="margin-top:0em;">
            <div class="col-md-12" style="margin-top:0em;">
                <div class="post" style="background-color:#c1c2c3;">
                    <div class="col-md-8">
                        <img src="/uploads/avatars/{{$user->avatar}}" style="width:100px; height:100px;float:left;margin-right:25px">
                        </img>
                        <h3>
                            {{$user->firstname}} {{$user->lastname}}
                        </h3>
                        <a href="/{{$user->id}}">
                            <button class="btn btn-primary btn-md">
                                Profil sehen
                            </button>
                        </a>
                        <a href="/{{$user->id}}/feedback/create">
                            <button class="btn btn-primary btn-md">
                                Bewerten
                            </button>
                        </a>
                        <a href="/{{$user->id}}/message">
                            <button class="btn btn-primary btn-md disabled">
                                Anonyme Nachricht schicken
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </li>
    </div>
    @endforeach
@endsection