// взять айдишник фидбека
// если нажал на реплай, то беру айдишник данного коммента
// генерю хтмл, и вставляю в него текст
// ищю айди фидбека и вставляю 
// если есть айдишник коммента то вставляю под него

$(document).ready(function(){
	var commentID = null;
	$('a.reply').on('click', function(){
		commentID = $(this).closest('.comment').data('comment-id');
		commentNode = $(this).closest('.comment');
		hasCommentsDiv = $(commentNode).children('.comments').length;
		
	});

	$('.add-reply').on('click', function(){
		var feedbackID = $(this).closest('.feedbacks').data('id');
		var text = $(this).closest('#comment-form').find('.form-control');
		var lastElement = 	$(this).closest('.comments').children('.comment').last();
		$.ajax({
		  method: "POST",
		  url: "/user/addComment",
		  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		  data: { 
		  	feedback_id: feedbackID, 
		  	comment_id : commentID,
		  	text: text.val()
		  }
		})
		  .done(function( data ) {
		  	if(commentID === null)
		  	{
			  	$(lastElement).after(data);
		  	}
		  	else
		  	{
		  		if(hasCommentsDiv === 0)
				{
					$(commentNode).append('<div class="comments"></div>');
				}
				commentNodeComments = $(commentNode).children('.comments');
				hasCommentNodeCommentsACommentInIt = $(commentNodeComments).children('.comment').length;
				if(hasCommentNodeCommentsACommentInIt > 0)
				{
					$(commentNodeComments).children('.comment').last().after(data);
				}
				else
				{
					$(commentNodeComments).append(data);
				}
		  	}
		  	

		  	commentID = null;
		  	$(text).val('');
		  });

		
	});
});