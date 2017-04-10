@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Settings</div>
                <div class="panel-body">
                        {{ Form::open(array(
                            'url'   =>  '/settings/update',
                            'role'  =>  'form',
                            'files' =>  true,
                            'class' =>  'form-horizontal'   
                        )) }}
                    <div class="col-md-3">

                        <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px;height:150px; float:left; border-width: 0.3px; margin-right:25px">
                        </img>
                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                            <label>Upload new profile picture.</label>
                            {{Form::file('avatar')}}
                            @if ($errors->has('avatar'))
                            <span class="help-block">
                                <strong>{{ $errors->first('avatar') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-9 profile-inputs" >

                        
                            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="firstname" class="col-md-4 control-label">Firstname</label>
                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" required autofocus>
                                    @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="lastname" class="col-md-4 control-label">Lastname</label>
                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->lastname }}" required autofocus>
                                    @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" value="">
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email_notifications') ? ' has-error' : '' }}">
                                <label for="email_notifications" class="col-md-4 control-label">Enable E-Mail Notifications</label>
                                <div class="col-md-6">
                                {{Form::checkbox('email_notifications', null,(bool)$user->email_notifications)}}
                                </div>
                                <br>
                                @if ($errors->has('email_notifications'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_notifications') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                    Submit
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection