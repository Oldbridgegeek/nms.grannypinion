{{-- settings page --}}
{{-- <a href="{{route('user.setting')}}" >
  <button class="btn btn-primary btn-md">{{ trans('app.settings') }}</button>
</a> --}}
{{-- share buttons --}}
<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=grannypinion.de/{{Auth::user()->id}}/feedback/create&display=popup"> 
  <button class="btn btn-primary btn-md" style="background: #3b5998;"> {{ trans('app.ask_facebook') }} </button>
</a>
<a class="twitter-share-button" target="_blank" href="https://twitter.com/intent/tweet?text={{trans('app.twitter')}} {{env('APP_URL')}}/{{Auth::user()->id}}/feedback/create"> 
  <button class="btn  btn-md" style="background: #3cf; color:#fff"> Twitter</button>
</a>
<p style="margin-top:1em;">{{ trans('app.share_facebook') }}: <b style="color:blue;"> {{env('APP_URL')}}/{{Auth::user()->id}}/feedback/create </b></p>