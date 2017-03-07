@extends('layouts.master')
@section('title')
Grannypinion - Profil
@endsection
@if (!Auth::guest())
@section('content')
<h1> {{$user->firstname}} {{$user->lastname}} </h1>
<img src="/storage/app/{{$user->profilePicture}}" style="width:20em;height:20em;">
                            </img>
<div class="panel-heading"> <h2> Bewertungen </h2> </div>
                <div class="panel-body">
                    <ul class="list-group">
                        @if(!empty($user->reviews))
                        @foreach( $user->reviews as $review )
                        <li class="list-group-item">
                           Gesamteindruck: {{$review->starsAverage}} von 10
                        </li>
                        <li class="list-group-item">
                           Ehrlichkeit: {{$review->starsHonesty}} von 10
                        </li>
                        <li class="list-group-item">
                           Zuverlässigkeit: {{$review->starsReliability}} von 10
                        </li>
                        <li class="list-group-item">
                           Attraktivität: {{$review->starsAttractiveness}} von 10
                        </li>
                        <li class="list-group-item">
                           Humor und Spaß: {{$review->starsFun}} von 10
                        </li>
                        <li class="list-group-item">
                           Freundlichkeit: {{$review->starsKindness}} von 10
                        </li>
                        <li class="list-group-item">
                           Intelligenz: {{$review->starsIntelligence}} von 10
                        </li>
                        <li class="list-group-item">
                           Feedback: {{$review->feedbackString}}
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
@endsection
@endif