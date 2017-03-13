@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px;height:150px; float:left; border-radius:50%; margin-right:25px">
            </img>
            <h2> {{$user->firstname}} {{$user->lastname}} </h2>
            @if($user->id == Auth::user()->id)
            <a href="{{route('user.setting',['user' => Auth::user()])}}" > <button>Einstellungen</button></a>
            @else
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
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        @if(!empty($user->reviews))
        @foreach( $user->reviews as $review )
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item">
                    <b>Feedback erstellt am: {{$review->created_at}}</b>
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
            </ul>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection