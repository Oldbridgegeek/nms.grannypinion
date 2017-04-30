@extends('layouts/app')

@section('content')
	<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron text-xs-center">
			  <h1 class="display-3">{{ trans('app.success') }}!</h1>
			  <p class="lead"><strong>{{ trans('app.feedback_added') }}</strong> </p>
			  <hr>
			  <p>
			    {{ trans('app.have_fun') }} <a href="/register">{{ trans('landing.sign_up') }}</a>
			  </p>
			  <p class="lead">
			    <a class="btn btn-primary btn-sm" href="/" role="button">{{ trans('app.continue') }}</a>
			  </p>
			</div>
		</div>
	</div>
</div>
@endsection