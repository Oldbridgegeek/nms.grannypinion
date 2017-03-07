@extends('layouts.master')
@section('title')
Grannypinion - Feedback
@endsection
@if (!Auth::guest())
@section('content')
<div class="row">
    <div class="col-md-6">
        <h3> Anonymes Feedback für {{$user->firstname}} {{$user->lastname}} </h3>
        <form class="form-horizontal" role="form" method="POST" action="/feedback">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">

            <div class="form-group">
                <label for="starsHonesty" class="control-label">Ehrlichkeit</label>
                <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsHonesty" id="starsHonesty">
            </div>
            <div class="form-group">
                <label for="starsAttractiveness" class="control-label">Attraktivität</label>
                <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsAttractiveness" id="starsAttractiveness">
            </div>
            <div class="form-group">
                <label for="starsReliability" class="control-label">Zuverlässigkeit</label>
                <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsReliability" id="starsReliability">
            </div>
            <div class="form-group">
                <label for="starsFun" class="control-label">Witzigkeit und Spaß</label>
                <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsFun" id="starsFun">
            </div>
            <div class="form-group">
                <label for="starsIntelligence" class="control-label">Intelligenz</label>
                <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsIntelligence" id="starsIntelligence">
            </div>
            <div class="form-group">
                <label for="starsKindness" class="control-label">Freundlichkeit</label>
                <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsKindness" id="starsKindness">
            </div>
            <div class="form-group">
                <label for="starsAverage" class="control-label">Gesamteindruck</label>
                <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsAverage" id="starsAverage">
            </div>
            <div class="form-group">
                <label for="feedbackString" class="control-label">Feedback</label>
                <textarea class="form-control" rows="5" name="feedbackString" id="feedbackString"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"> Bestätigen </button>
        </form>
    </div>
</div>
@endsection
@endif