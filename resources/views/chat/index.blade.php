@extends('layouts.app')

@section('content')
<style>
	@media (max-width: 767px) {
    .visible-xs {
        display: inline-block !important;
    }
    .block {
        display: block !important;
        width: 100%;
        height: 1px !important;
    }
}


.c-search > .form-control {
   border-radius: 0px;
   border-width: 0px;
   border-bottom-width: 1px;
   font-size: 1.3em;
   padding: 12px 12px;
   height: 44px;
   outline: none !important;
}
.c-search > .form-control:focus {
    outline:0px !important;
    -webkit-appearance:none;
    box-shadow: none;
}
.c-search > .input-group-btn .btn {
   border-radius: 0px;
   border-width: 0px;
   border-left-width: 1px;
   border-bottom-width: 1px;
   height: 44px;
}


.c-list {
    padding: 0px;
    min-height: 44px;
}
.title {
    display: inline-block;
    font-size: 1.5em;
    font-weight: bold;
    padding: 5px 15px;
}
ul.c-controls {
    list-style: none;
    margin: 0px;
    min-height: 44px;
}

ul.c-controls li {
    margin-top: 8px;
    float: left;
}

ul#contact-list li a{
    text-decoration: none;
    color: #3765b9;
}

ul#contact-list li a span.time
{
	color: #aaa;
}

ul.c-controls li a {
    font-size: 1.7em;
    padding: 11px 10px 6px;  
}
ul.c-controls li a i {
    min-width: 24px;
    text-align: center;
}

ul.c-controls li a:hover {
    background-color: rgba(51, 51, 51, 0.2);
}

.c-toggle {
    font-size: 1.7em;
}

.name {
    font-size: 1.3em;
    font-weight: 700;
}

.c-info {
    padding: 5px 10px;
    font-size: 1.25em;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading c-list">
                    <span class="title">Recent chats</span>
                </div>
                
                <ul class="list-group" id="contact-list">
                @forelse($rooms as $room)
					@if($room->anonymousChat())
						<li class="list-group-item">
	                        <a href="/room/{{$room->room_id}}">
	                        	<div class="col-xs-12 col-sm-3">
		                            <img src="{{$room->pal->getImage()}}" alt="{{$room->pal->getFullName()}}" class="img-responsive img-circle" width="70" />
		                        </div>
		                        <div class="col-xs-12 col-sm-9">
		                            <span class="name">{{$room->pal->getFullName()}} </span><span class="time">({{ trans('app.started') }} {{$room->created_at->diffForHumans()}})</span><br/>
		                            <a href="/{{$room->pal->id}}"><span class="glyphicon glyphicon-user text-muted c-info" data-toggle="tooltip" title="{{ trans('app.profile') }}"></span></a>
		                            <a href="/{{$room->pal->id}}/feedback/create"><span class="glyphicon glyphicon-comment text-muted c-info" data-toggle="tooltip" title="{{ trans('app.feedback') }}"></span></a>
		                        </div>
		                        <div class="clearfix"></div>
	                        </a>
	                    </li>
					@else
						<li class="list-group-item">
	                        <a href="/room/{{$room->room_id}}">
	                        	<div class="col-xs-12 col-sm-3">
		                            <img src="/uploads/avatars/default/default.jpg" alt="{{ trans('app.anonymous_user') }}" class="img-responsive img-circle" width="70" />
		                        </div>
		                        <div class="col-xs-12 col-sm-9">
		                            <span class="name">{{ trans('app.anonymous_user') }}</span> <span class="time">({{ trans('app.started') }} {{$room->created_at->diffForHumans()}})</span><br/>
		                            
		                        </div>
		                        <div class="clearfix"></div>
	                        </a>
	                    </li>
					@endif
				@empty
					You have no chats
				@endforelse
                    
                </ul>
            </div>
        </div>
	</div>
    
    <div id="cant-do-all-the-work-for-you" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Ooops!!!</h4>
                </div>
                <div class="modal-body">
                    <p>I am being lazy and do not want to program an "Add User" section into this snippet... So it looks like you'll have to do that for yourself.</p><br/>
                    <p><strong>Sorry<br/>
                    ~ Mouse0270</strong></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScrip Search Plugin -->
    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
    
</div>

@endsection

@section('customJS')
<script>
	$('#contact-list').searchable({
        searchField: '#contact-list-search',
        selector: 'li',
        childSelector: '.col-xs-12',
        show: function( elem ) {
            elem.slideDown(100);
        },
        hide: function( elem ) {
            elem.slideUp( 100 );
        }
    })
</script>
@endsection