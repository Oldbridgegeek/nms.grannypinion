@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Here your chats</h2>
			@forelse($rooms as $room)
				<ul>
					<li>
						<img src="{{$room->pal->getImage()}}" alt="" width="50">
						<a href="/room/{{$room->room_id}}">{{$room->pal->getFullName()}}</a>
					</li>
				</ul>
			@empty
				You have no chats
			@endforelse
		</div>
	</div>
</div>
@endsection