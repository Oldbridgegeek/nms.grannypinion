
<h4>Dear {{$user->getFullName()}}</h4>


<p>
You have been received a new commentary from {{$commentSender}}</a> is saying:
<p>
	"{{$comment->text}}"

	<a href="{{
	route('check.comment',[
		'user'=>$comment->feedback->user->id,
		'comment'=>$comment->id
	])
}}">(reply)
</a>
</p>

</p>


<p>
grannypinion.de
</p>