@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" style="border-style: solid;border-width: 0px;">
            <div class="row" style="border-style: solid; border-width: 0.2px; box-shadow: 1px 1px grey; background-color: #fdfdfd;">
            <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px;height:150px; float:left; border-radius:0%; margin-right:25px">
            </img>
            <h2> {{$user->firstname}} {{$user->lastname}} </h2>
            @if($user->id == Auth::user()->id)
            <a href="{{route('user.setting',['user' => Auth::user()])}}" > <button class="btn btn-primary btn-md">Einstellungen</button></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=grannypinion.de/{{Auth::user()->id}}/feedback/create&display=popup"> <button class="btn btn-primary btn-md"> Frage auf Facebook nach Feedback </button> </a>
            <p style="margin-top:1em;">Teile den Link mit deinen Freunden, damit du Feedback bekommst: <b style="color:blue;"> www.grannypinion.de/{{Auth::user()->id}}/feedback/create </b></p>
            @else
            <a href="/{{$user->id}}/feedback/create">
                <button class="btn btn-primary btn-md">
                Feedback
                </button>
            </a>
            <a href="/{{$user->id}}/message">
                <button class="btn btn-primary btn-md disabled">
                Anonyme Nachricht
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


                    <b>{{$review->created_at->format('d.m.Y')}}</b>
                @if($review->stars_average != NULL)
                <li class="list-group-item">
                    Gesamteindruck: <input type="hidden" class="rating" disabled="disabled" value="{{$review->stars_average}}"/> 
                </li>
                @endif
                @if($review->stars_honesty != NULL)
                <li class="list-group-item">
                    Ehrlichkeit: <input type="hidden" class="rating" disabled="disabled" value="{{$review->stars_honesty}}"/>
                </li>
                @endif
                @if($review->stars_reliability != NULL)
                <li class="list-group-item">
                    Zuverlässigkeit: <input type="hidden" class="rating" disabled="disabled" value="{{$review->stars_reliability}}"/>
                </li>
                @endif
                @if($review->stars_attractiveness != NULL)
                <li class="list-group-item">
                    Attraktivität: <input type="hidden" class="rating" disabled="disabled" value="{{$review->stars_attractiveness}}"/>
                </li>
                @endif
                @if($review->stars_fun != NULL)
                <li class="list-group-item">
                    Humor und Spaß: <input type="hidden" class="rating" disabled="disabled" value="{{$review->stars_fun}}"/>
                </li>
                @endif
                @if($review->stars_kindness != NULL)
                <li class="list-group-item">
                    Freundlichkeit: <input type="hidden" class="rating" disabled="disabled" value="{{$review->stars_kindness}}"/>
                </li>
                @endif
                @if($review->stars_intelligence != NULL)
                <li class="list-group-item">
                    Intelligenz: <input type="hidden" class="rating" disabled="disabled" value="{{$review->stars_intelligence}}"/>
                </li>
                @endif
                @if($review->feedback != NULL)
                <li class="list-group-item">
                    {{$review->feedback}}
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