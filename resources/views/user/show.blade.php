@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" style="border-style: solid;border-width: 0px;">
            <div class="row" style="border-style: solid; border-width: 0.5px; box-shadow: 1px 1px grey;">
            <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px;height:150px; float:left; border-radius:0%; margin-right:25px">
            </img>
            <h2> {{$user->firstname}} {{$user->lastname}} </h2>
            @if($user->id == Auth::user()->id)
            <a href="{{route('user.setting',['user' => Auth::user()])}}" > <button class="btn btn-primary btn-md">Einstellungen</button></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=grannypinion.com/' .urlencode($user_id).'/feedback/create&display=popup"> <button class="btn btn-primary btn-md"> Frage auf Facebook nach Feedback </button> </a>
            @else
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
            @endif
            </div>
        </div>
        </div>
    </div>
</div>
<div class="container">
<div class="col-md-12" style="margin-top:0em;">
        @if(!empty($user->reviews))
        @foreach( $user->reviews as $review )
            <ul class="list-group" style="margin-top:2em;box-shadow: 1px 3px 2px 2px grey;">
                <div class="post" style="background-color:#c1c2c3;">

                <li class="list-group-item">
                    <b>Feedback erstellt am: {{$review->created_at->format('d.m.Y')}}</b>
                </li>
                @if($review->stars_average != NULL)
                <li class="list-group-item">
                    Gesamteindruck: {{$review->stars_average}} von {{ config('review.max_stars') }}
                </li>
                @endif
                @if($review->stars_honesty != NULL)
                <li class="list-group-item">
                    Ehrlichkeit: {{$review->stars_honesty}} von {{ config('review.max_stars') }}
                </li>
                @endif
                @if($review->stars_reliability != NULL)
                <li class="list-group-item">
                    Zuverlässigkeit: {{$review->stars_reliability}} von {{ config('review.max_stars') }}
                </li>
                @endif
                @if($review->stars_attractiveness != NULL)
                <li class="list-group-item">
                    Attraktivität: {{$review->stars_attractiveness}} von {{ config('review.max_stars') }}
                </li>
                @endif
                @if($review->stars_fun != NULL)
                <li class="list-group-item">
                    Humor und Spaß: {{$review->stars_fun}} von {{ config('review.max_stars') }}
                </li>
                @endif
                @if($review->stars_kindness != NULL)
                <li class="list-group-item">
                    Freundlichkeit: {{$review->stars_kindness}} von {{ config('review.max_stars') }}
                </li>
                @endif
                @if($review->stars_intelligence != NULL)
                <li class="list-group-item">
                    Intelligenz: {{$review->stars_intelligence}} von {{ config('review.max_stars') }}
                </li>
                @endif
                @if($review->feedback != NULL)
                <li class="list-group-item">
                    Feedback: {{$review->feedback}}
                </li>
                @endif
                </div>

            </ul>
        @endforeach
        @endif
        </div>
                </div>

</div>
@endsection