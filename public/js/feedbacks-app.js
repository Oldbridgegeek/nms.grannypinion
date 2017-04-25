// window.onload = function () {
	let newComment = {
		text: '',
		isAnonymous: false
	}
	Vue.component('feedbacks',{
		data: function(){
			return {
				confirmationQuestion: null,
				currentUser: '',
				messages: [],
				feedbacks: [],
				comment: newComment,
				replyTo: ''

			}
		},
		created: function()
		{
			this.fetchData();
		},
		methods: 
		{
			getUserId: function()
			{
				let first = $(location).attr('pathname');

				first.indexOf(1);

				first.toLowerCase();

				return first.split("/")[1];
			},
			fetchData: function()
			{
				
				let user_id = this.getUserId();

				vm = this;
				$.ajax({
				  method: "GET",
				  url: "/feedback/getFeedbacks",
				  // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				  data: { user_id: user_id}
				})
				  .done(function( data ) {
				  	vm.confirmationQuestion = data.confirmationQuestion;
				  	vm.currentUser = data.currentUser;
				  	vm.feedbacks = data.feedbacks;
				  	vm.messages = data.messages;
				  });
			},
			switchStatus: function(feedback)
			{
				let status = null;

				status = feedback.isStatusPublic === true ? false : true;
				
				vm = this;
				$.ajax({
				  method: "POST",
				  url: "/feedback/switch",
				  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				  data: { feedback_id: feedback.id}
				})
				  .done(function( data ) {
				  	feedback.isStatusPublic = status;
				  });

			},

			removeFeedback: function(index,feedback)
			{
				if (confirm(this.confirmationQuestion)) {
					vm = this;
					$.ajax({
					  method: "POST",
					  url: "/feedback/delete",
					  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					  data: { feedback_id: feedback.id}
					})
					  .done(function( data ) {
						vm.feedbacks.splice(index, 1);
					  });
				}
			},

			isUserAllowedToView: function(feedback)
			{
				if (!feedback.isStatusPublic) {
					if (!feedback.isAuthor) {
						return false;
					}
				}
				return true;
			},

			
			addComment: function(feedback)
			{

				vm = this;

				$.ajax({
				  method: "POST",
				  url: "/feedback/addComment",
				  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				  data: { feedback_id: feedback.id, comment: vm.comment.text} //then need to ANONYMOUS
				})
				  .done(function( data ) {
				  	vm.add(feedback);
				  });
			},

			add: function(feedback)
			{
				feedback.comments.push(
				  	{
				  		id: this.currentUser.id,
				  		text: this.comment.text,
				  		action: this.messages.reply,
				  		date: this.messages.justNow,
				  		user: 
					  		{	id: this.currentUser.id,
					  			fullName: this.currentUser.fullName,
					  			image: this.currentUser.image
					  		},
				  		hasChildren: false,
				  		children: []
				  	}
			  	);
			  	this.comment.text = '';
			},

		    






		},
		template: `
		<div>
		<div
	      :class="['panel', 'panel-default', 'feedbacks', feedback.isStatusPublic ? 'public-feedback' : 'hidden-feedback']" 
	      v-for="(feedback, index) in feedbacks" v-if="isUserAllowedToView(feedback)">

	      <div class="panel-heading">{{feedback.title}} ({{feedback.date}})

	        <ul class="feedback-settings">
	          <li class="toggle-status" v-if="feedback.isAuthor" @click="switchStatus(feedback)">
	                <span v-if="feedback.isStatusPublic">
	                  <i class="glyphicon glyphicon-eye-close"></i>
	                  {{messages.makePrivate}}
	                </span>
	                <span v-else>
	                  <i class="glyphicon glyphicon-eye-open"></i>
	                  {{messages.makePublic}}
	                </span>
	          </li>
	          <li class="delete-feedback" v-if="feedback.isAuthor" @click="removeFeedback(index,feedback)">
	            <i class="glyphicon glyphicon-remove"></i>
	          </li>
	        </ul>                

	         <!-- <div class="clearfix"></div> -->
	      </div>
	      <div class="panel-body">
	        <div class="feedback-content">
	            {{feedback.content}}
	        </div>
	        <hr>
	        <div class="ui comments">
	         <comment v-for="( comment, index ) in feedback.comments"
	         	:key="comment.id"
	         	:comment="comment"
	         	:index="index"
	         	:currentUser="currentUser"
	         	>
	         </comment> 
	          <br> 
	          <form class="ui reply form " id="comment-form">
	            <div class="field">
	              <textarea class="form-control" v-model="comment.text"></textarea>
	            </div>
	            <br>
	            <div class="btn btn-success add-reply" @click="addComment(feedback)">
	              <i class="glyphicon glyphicon-comment"></i> {{messages.addReply}}
	            </div>
	            <div class="btn cancel-reply">
	              <a href="#"><span class="comment-username"></span> </a>
	            </div>
	          </form>
	        </div>
	      </div>
	  </div>
	  </div>
		`
	});
// }