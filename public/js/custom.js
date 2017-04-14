//кликаю по реплай
//скрол до первой текстаери
//
$(document).ready(function(){
	var commentID = null;
	$('a.reply').on('click', function(){
		commentID = $(this).closest('.comment').data('comment-id');
		commentNode = $(this).closest('.comment');
		hasCommentsDiv = $(commentNode).children('.comments').length;

		comments = $(this).closest('.ui');
		form = comments.find('.form');
		$('html, body').animate({
	        scrollTop: $(form).offset().top - 20
	    }, 2000);
	    author = $(this).closest('.content').children('.author').text();
	    $(form).find('.comment-username').html(author + ' <i class="glyphicon glyphicon-remove"></i>');

	});

	$('.cancel-reply').on('click', function(e){
		e.preventDefault();
		$(form).find('.comment-username').html('');
		commentID = null;
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
		  	$(form).find('.comment-username').html('');

		  });

		
	});
});