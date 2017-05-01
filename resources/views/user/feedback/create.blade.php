@extends('layouts.app')
@section('content')
<style>
</style>
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <form action="/{{$user->id}}/feedback/leave" method="POST">
                {{csrf_field()}}
                <div class="col-md-2 col-md-offset-1">
                    <div class="user-image">
                        <img class="img-thumbnail" src="{{$user->getImage()}}" width="150" height="150">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="user-review form-group{{ $errors->has('review') ? ' has-error' : '' }}">
                        <h3>{{ trans('app.leave_feedback') }}: <b>{{$user->getFullName() }}</b></h3>
                        <textarea name="text" class="form-control"></textarea>
                        @if ($errors->has('review'))
                            <span class="help-block">
                                <strong>{{ $errors->first('review') }}</strong>
                            </span>
                        @endif
                        <button class="btn btn-success">{{ trans('app.submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection