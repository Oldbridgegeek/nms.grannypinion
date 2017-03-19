@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-5">
            {{$poll->name}}
        </div>
        <div class="col-md-10 col-md-offset-1">
        
        </div>
    </div>
</div>
@endif
@endsection