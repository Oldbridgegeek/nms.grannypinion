@if($feedback->isPublic())
<i class="glyphicon glyphicon-eye-close"></i>
{{ trans('app.make_private') }}

@else
<i class="glyphicon glyphicon-eye-open"></i>
{{ trans('app.make_public') }}
@endif