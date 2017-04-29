<a href="{{route('chatRoom',['id'=>$user->id])}}">
    <button class="btn btn-primary btn-md">
    {{ trans('app.anonymous_message') }}
    </button>
</a>
<a href="/{{$user->id}}/feedback/create">
    <button class="btn btn-primary btn-md">
    {{ trans('app.feedback') }}
    </button>
</a>    