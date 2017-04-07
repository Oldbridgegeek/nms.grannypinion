@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-2">
        <h2> Thank you.</h2>
        <h3> If you are also interested in getting anonymous feedback, sign up for free at our plattform.</h3>
        <a href={{ route('welcome')}}> <button class="btn btn-success btn-block"> Sign Up </button> </a>
    </div>
</div>
@endsection