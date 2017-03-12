@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <p>Settings</p>
            <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px;height:150px; float:left; border-radius:50%; margin-right:25px">
            </img>
            <form enctype="multipart/form-data" action="{{ route('user.avatar',['user' => Auth::user()]) }}" method="POST">
            <label>Lade ein neues Bild hoch.</label>
            <input type="file" name="avatar">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection