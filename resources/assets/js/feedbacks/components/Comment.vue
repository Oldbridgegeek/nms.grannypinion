<template>
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
	        	
	        <a class="reply" @click="replyComment(feedback,comment)" v-if="currentUser.id != comment.user.id">{{comment.action}}</a>
	        
	      </div>
	    </div>
	  	<div v-if="comment.children && comment.children.length > 0">
	  		<div class="comments">
				<comment v-for="( comment, index ) in comment.children"
		         	:key="comment.id"
		         	:comment="comment"
		         	:index="index"
		         	:feedback="feedback"
		         	>
		         </comment> 
		     </div>
	    </div>
	</div>
</template>

<script>
	export default {
		name: "comment",
		props: ['comment', 'feedback'],
		computed: {
			currentUser()
			{
				return this.$store.getters.currentUser;
			}
		},
		methods: {
			replyComment: (feedback, comment) => {
				feedback.replyTo = '';
				feedback.replyTo = { username: comment.user.fullName, comment: comment};

			}
		}

	}
</script>

<style>
	
</style>