{{-- settings page --}}
<a href="{{route('user.setting')}}" >
  <button class="btn btn-primary btn-md">{{ trans('app.settings') }}</button>
</a>
{{-- share buttons --}}
<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=grannypinion.de/{{Auth::user()->id}}/feedback/create&display=popup"> 
  <button class="btn btn-primary btn-md"> {{ trans('app.ask_facebook') }} </button>
</a>
<p style="margin-top:1em;">{{ trans('app.share_facebook') }}: <b style="color:blue;"> {{env('APP_URL')}}/{{Auth::user()->id}}/feedback/create </b></p>