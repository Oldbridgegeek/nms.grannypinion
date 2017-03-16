@extends('layouts.app')

@section('content')
    @foreach ($users as $user)
    <div class="container">
        <div class="row" style="margin-top:2em;">
            <div class="col-md-10 col-md-offset-1" style="border-style: solid;border-width: 0px;">
                <div class="row" style="border-style: solid; border-width: 0.5px; box-shadow: 0.5px 0.5px 0.5px 0.5px grey; background-color: #fdfdfd;">
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
    @endforeach

@endsection