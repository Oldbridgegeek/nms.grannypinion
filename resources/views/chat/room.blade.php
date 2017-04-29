@extends('layouts.app')

@section('content')
<div class="container" id="chatbox">
	<div class="row">
		<div class="col-md-12">
			<chatbox
			:messages="messages"
			:current-user="currentUser"
			:pal="pal"
			:additional-info="additionalInfo"
			v-on:messagesent="addMessage"
			></chatbox>
		</div>
	</div>
</div>

 @endsection

@section('customJS')
	<script src="/js/chatbox-app.js"></script>
@endsection