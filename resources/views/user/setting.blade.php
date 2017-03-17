@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Einstellungen</div>
                <div class="panel-body">
                <div class="col-md-12">
                <img src="/uploads/avatars/{{Auth::user()->avatar}}" style="width:150px;height:150px; float:left; border-width: 0.3px; margin-right:25px">
                </img>
                <form enctype="multipart/form-data" action="{{ route('user.avatar') }}" method="POST">
                    <label>Lade ein neues Profilbild hoch.</label>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                </form>
                </div>
                <div class="col-md-12" style="margin-top:2em;">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('user.update') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                        <label for="firstname" class="col-md-4 control-label">Vorname</label>
                        <div class="col-md-6">
                            <input id="firstname" type="text" class="form-control" name="firstname" value="{{ Auth::user()->firstname }}" required autofocus>
                            @if ($errors->has('firstname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                        <label for="lastname" class="col-md-4 control-label">Nachname</label>
                        <div class="col-md-6">
                            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ Auth::user()->lastname }}" required autofocus>
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
                            <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Passwort</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" value="{{ Auth::user()->password }}" required>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Passwort Bestästigen</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ Auth::user()->password }}" required>
                       </div>
                    </div>

                    <div class="form-group">
                        <label for="email_notification" class="col-md-4 control label"> Email Benachrichtigung</label>
                        <div class="col-md-6">
                            <input type="checkbox" id="email_notification" name="email_notification" @if(!Auth::user()->email_notifications) checked @endif> Email Benachrichtigung abstellen<br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                            Ändern
                            </button>
                        </div>
                    </div>
                </form>
                </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection