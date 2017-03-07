@extends('layouts.master')
@section('title')
Grannypinion - Anonyme Nachricht
@endsection
@if (!Auth::guest())
@section('content')
<div class="row">
    <div class="col-md-6">
        <h3> Anonyme Nachricht an {{$user->firstname}} {{$user->lastname}} </h3>
        <form class="form-horizontal" role="form" method="POST" action="/message">
            {{ csrf_field() }}
            <input type="hidden" name="sending_user_id" id="sending_user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="receiving_user_id" id="receiving_user_id" value="{{$user->id}}">
            <div class="form-group">
                <label for="message" class="control-label">Anonyme Nachricht</label>
                <textarea class="form-control" rows="10" name="text" id="text"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"> Senden </button>
        </form>
    </div>
</div>
@endsection
@endif