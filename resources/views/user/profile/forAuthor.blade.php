<!-- Split button -->
<div class="btn-group">
	<a href="/settings" class="btn btn-primary">{{ trans('app.settings') }}</a>
</div>
<div class="btn-group">
    <button type="button" class="btn btn-primary">
        {{ trans('app.share') }}!</button>
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span><span class="sr-only">Social</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="https://twitter.com/intent/tweet?text={{trans('app.twitter')}} {{env('APP_URL')}}/{{Auth::user()->id}}/feedback/create">Twitter</a></li>
        <li><a href="https://www.facebook.com/sharer/sharer.php?u=grannypinion.de/{{Auth::user()->id}}/feedback/create&display=popup">Facebook</a></li>
    </ul>
    
</div>
<br>
    <div class="form-group" style="margin-top:10px;">
        <label>Share your link</label>
        <input type="text" disabled class="form-control" style="width:60%" value="{{env('APP_URL')}}/{{Auth::user()->id}}/feedback/create">
    </div>