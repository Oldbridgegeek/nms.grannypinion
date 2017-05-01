<div class="comment">
  <a class="avatar">
    <img src="{{$comment->user->getImage()}}">
  </a>
  <div class="content">
    <a class="author">{{$comment->user->getFullName()}}</a>
    <div class="metadata">
      <span class="date">{{$comment->created_at->diffForHumans()}}</span>
    </div>
    <div class="text">
      {{$comment->text}}
    </div>
    <div class="actions">
    @if(Auth::user()->id != $comment->user->id)
      <a class="reply">{{ trans('app.reply') }}</a>
    @endif
    </div>
  </div>
</div>