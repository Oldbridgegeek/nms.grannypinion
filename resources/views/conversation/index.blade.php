@extends('layouts.app')

@section('content')
	Conversations I started.
	<ul class="list-group">
	    @forelse ( $conversationsStarted as $convStarted )
	    	<li>
	    		<a href="{{ route('conversation.show', [ 'conversation' => $convStarted->id]) }}"> {{$convStarted->id}} </a>
	    		<p>
	    			<strong>Text</strong><br/>
	    			@foreach ($convStarted->messages as $message)
						{{ $message->body }}
	    			@endforeach
	    		</p>
	    	</li>
	    @empty
	    	<br/>
			{{ config('conversation.no_conversation_found')}}
		@endforelse
	    <hr/>
	    Conversations I did not started.
	    @forelse ( $conversationsReceived as $convReceived )
	    	<li>
	    		<a href="{{ route('conversation.show', [ 'conversation' => $convReceived->id]) }}"> {{$convReceived->id}} </a>
				<p>
	    			<strong>Text</strong><br/>
	    			@foreach ($convReceived->messages as $message)
						{{ $message->body }}
	    			@endforeach
				</p>
    		</li>
	    @empty
	    	<br/>
			{{ config('conversation.no_conversation_found')}}
		@endforelse
	</ul>
@endsection