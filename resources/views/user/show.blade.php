@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px;height:150px; float:left; border-radius:50%; margin-right:25px">
            </img>
            <h2> {{$user->firstname}} {{$user->lastname}} </h2>
            <div class="panel-heading"> <h2> Bewertungen </h2> </div>
            <div class="panel-body">
                <ul class="list-group">
                    @if(!empty($user->reviews))
                    @foreach( $user->reviews as $review )
                    <li class="list-group-item">
                        Gesamteindruck: {{$review->stars_average}} von {{ config('review.max_stars') }}
                    </li>
                    <li class="list-group-item">
                        Ehrlichkeit: {{$review->stars_honesty}} von {{ config('review.max_stars') }}
                    </li>
                    <li class="list-group-item">
                        Zuverlässigkeit: {{$review->stars_reliability}} von {{ config('review.max_stars') }}
                    </li>
                    <li class="list-group-item">
                        Attraktivität: {{$review->stars_attractiveness}} von {{ config('review.max_stars') }}
                    </li>
                    <li class="list-group-item">
                        Humor und Spaß: {{$review->stars_fun}} von {{ config('review.max_stars') }}
                    </li>
                    <li class="list-group-item">
                        Freundlichkeit: {{$review->stars_kindness}} von {{ config('review.max_stars') }}
                    </li>
                    <li class="list-group-item">
                        Intelligenz: {{$review->stars_intelligence}} von {{ config('review.max_stars') }}
                    </li>
                    <li class="list-group-item">
                        Feedback: {{$review->feedback}}
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection