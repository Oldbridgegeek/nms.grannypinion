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
        <a class="reply">{{ trans('app.reply') }}</a>
      </div>
    </div>
    @if(count($comment->children) && !empty($comment->children))
      <div class="comments">
        @foreach($comment->children as $child)
          @include('user._comment',['comment'=>$child])
        @endforeach
      </div>
      
    @endif
  </div>