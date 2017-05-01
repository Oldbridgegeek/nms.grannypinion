<div class="form-group">
	<label>{{$reply->question->title}}</label>
	<p>
		{{$reply->title}} 
		@if($reply->title == null)
		<i>(not specified)</i>
		@endif
	</p>
</div>