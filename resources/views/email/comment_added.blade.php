
<h4>Dear {{$user->getFullName()}}</h4>


<p>
You have been received a new commentary from <a href="{{route('user.show', ['user'=>$commentSender])}}">{{$commentSender->getFullName()}}</a> is saying:
<p>
	"{{$comment->text}}"

	<a href="{{
	route('check.comment',[
		'user'=>$commentSender->id,
		'comment'=>$comment->id
	])
}}">(reply)
</a>
</p>

</p>


<p>
grannypinion.de
</p>