window.onload = function () {

Vue.component('comment', {
	props: ['comment','currentUser'],
	data: function()
	{
		return {
			
		};
	},
	template: `
	  <div class="comment">
	    <a class="avatar">
	      <img :src="comment.user.image">
	    </a>
	    <div class="content">
	      <a class="author">{{comment.user.fullName}}</a>
	      <div class="metadata">
	        <span class="date">{{comment.date}}</span>
	      </div>
	      <div class="text">
	        {{comment.text}}
	      </div>
	      <div class="actions">
	        	
	        <a class="reply" @click="replyComment(comment)" v-if="currentUser.id != comment.user.id">{{comment.action}}</a>
	        
	      </div>
	    </div>
      	<div v-if="comment.children && comment.children.length > 0">
      		<div class="comments">
				<comment v-for="( comment, index ) in comment.children"
		         	:key="comment.id"
		         	:comment="comment"
		         	:index="index"
		         	:currentUser="currentUser"
		         	>
		         </comment> 
		     </div>
	      </div>
	  	</div>
	`,

	methods: {

		replyComment: function(comment)
		{
			vm = this;

			$.ajax({
			  method: "POST",
			  url: "/feedback/addReply",
			  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			  data: { parentComment: comment, newComment: newComment } //then need to ANONYMOUS
			})
			  .done(function( data ) {
			  	// console.log(data);
			  });

			
		},
		addComment: function(feedback)
		{
			let el = {
			  		id: 1,
			  		text: newComment.text,
			  		action: 'reply',
			  		date: 'just now',
			  		user: 
				  		{	id: 111,
				  			fullName: 'John Doe',
				  			image: '/uploads/image.jpg'
				  		},
			  		children: []
		  	};
			
			
			comment.children.push(el);
							
		},
	},
	
});
new Vue({
	el: '#commentaries-app',
	data: {
		
	},	
});

}