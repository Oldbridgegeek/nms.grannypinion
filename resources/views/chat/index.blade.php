@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Here your chats</h2>
				<ul>

			@forelse($rooms as $room)
					@if($room->anonymousChat())
						<li>
							<img src="{{$room->pal->getImage()}}" alt="" width="50">
							<a href="/room/{{$room->room_id}}">{{$room->pal->getFullName()}}</a>
						</li>
					@else
						<li>
							<img src="/uploads/avatars/default/default.jpg" alt="" width="50">
							<a href="/room/{{$room->room_id}}">{{ trans('app.anonymous_user') }}</a>
						</li>
					@endif
			@empty
				You have no chats
			@endforelse
				</ul>
		</div>
	</div>
</div>
@endsection