<template>
	<div>
		<div
	      :class="['panel', 'panel-default', 'feedbacks', feedback.isStatusPublic ? 'public-feedback' : 'hidden-feedback']" 
	      v-for="(feedback, index) in feedbacks" v-if="isUserAllowedToView(feedback)">

	      <div class="panel-heading"><span class="hidden-xs">{{feedback.title}}</span> ({{feedback.date}})

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
	         <comment  v-for="( comment, index ) in feedback.comments"
	         	:key="comment.id"
	         	:comment="comment"
	         	:index="index"
	         	:feedback="feedback">
	         </comment> 
	          <br> 
	          <form class="ui reply form " id="comment-form">
	            <div class="field">
	              <textarea class="form-control" v-model="feedback.newComment"></textarea>
	            </div>
	            <br>
	            <div class="btn btn-success add-reply" @click="addComment(feedback)">
	              <i class="glyphicon glyphicon-comment"></i> {{messages.addReply}}
	            </div>
	            <div class="cancel-reply pull-right" >
	              <span class="comment-username"><input type="checkbox" v-model="feedback.anonymousReply"> {{messages.reply_anonymously}}</span>
	            </div>
	            <div class="btn cancel-reply" v-if="feedback.replyTo != ''" @click.prevent="cancelReply(feedback)">
	              <a href="#" ><span class="comment-username">{{feedback.replyTo.username}} <i class="glyphicon glyphicon-remove"></i></span> </a>
	            </div>
	          </form>
	        </div>
	      </div>
	  </div>
	</div>
</template>

<script>
	// import { mapGetters } from 'vuex';
	import Comment from '../components/Comment';

	export default {
		name: 'feedbacks',
		components: {Comment},
		computed: {
			feedbacks(){
				return this.$store.getters.feedbacks;
			},

			messages(){
				return this.$store.getters.messages;
			}
		},
		created()
		{
			// this.$store.dispatch('LOAD_FEEDBACKS_LIST');
		},
		methods: {
			addComment: function(feedback)
			{
				this.$store.dispatch('addComment', feedback);
			},

			cancelReply: function(feedback)
			{
				this.$store.commit('cancelReply', feedback);
			},

			isUserAllowedToView: feedback => {
				if (!feedback.isStatusPublic) {
					if (!feedback.isAuthor) {
						return false;
					}
				}
				return true;
			},
			switchStatus(feedback)
			{
				this.$store.dispatch('switchStatus',feedback);
			},

			removeFeedback: function(index,feedback)
			{
				this.$store.dispatch('removeFeedback',{
					id: feedback.id,
					index: index
				});
			},
		}
	}
</script>

<style>
	
</style>