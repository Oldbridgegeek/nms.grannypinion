<div class="form-group">
	<label>{{$reply->question->title}}</label>
	<div class="rate{{$reply->id}}"></div>
	<input type="hidden" data-value="{{$reply->title}}">
	@if($reply->title == 0)
	<i>(not specified)</i>
	@endif
</div>

<script>
    $(".rate" + '{{ $reply->id }}').rateYo({
        precision: 1,
        starWidth: "25px",
        spacing: "3px",
        readOnly: true,
        rating: '{{$reply->title}}'
      });
</script>
