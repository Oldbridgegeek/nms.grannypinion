import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

Vue.use(Vuex);
const store = new Vuex.Store({
	state: {
		confirmationQuestion: null,
		currentUser: '',
		messages: [],
		feedbacks: [],
		comment: '',
	},
	actions: {
		LOAD_FEEDBACKS_LIST: function ({ commit }) {
			
	      store.dispatch('getUserID').then(function(user_id){
	      		axios.get('/feedback/getFeedbacks',{

		      	params: {
		      		user_id: user_id
		      	}

		      }).then((response) => {
		        commit('SET_FEEDBACKS_LIST', response.data)
		      }, (err) => {
		        console.log(err)
		      })
	      		
	      });
	    },

	    getUserID: function()
	    {
	    	let first = $(location).attr('pathname');

			first.indexOf(1);

			first.toLowerCase();

			return first.split("/")[1];
	    },

	    removeFeedback: (context, feedback) => {
	    	if (confirm(context.state.confirmationQuestion)) {
				axios.post('/feedback/delete', {
				    feedback_id: feedback.id
				})
				.then(function (response) {
				    context.commit({
				    	type: 'removeFeedback',
				    	index: feedback.index
				    })
				})
				.catch(function (error) {
				    console.log(error);
				});
			}
	    },

	    switchStatus: (context, feedback) => {
	    	let status = null;

			status = feedback.isStatusPublic === true ? false : true;

			axios.post('/feedback/switch', {
			    feedback_id: feedback.id
			  })
			  .then(function (response) {
			    context.commit('switchStatus', {
			    	feedback: feedback,
			    	status: status
			    });
			  })
			  .catch(function (error) {
			    console.log(error);
			  });
	    },

	    addComment: (context, feedback) => {
			axios.post('/feedback/addComment', {
			    feedback_id: feedback.id, comment: feedback.newComment, replyTo: feedback.replyTo.comment//then need to ANONYMOUS
			})
			.then(function (response) {
			    context.commit('addComment',feedback);
			})
			.catch(function (error) {
			    console.log(error);
			});
	    }
	},
	mutations: {
		SET_FEEDBACKS_LIST: (state, data) => {
			state.confirmationQuestion = data.confirmationQuestion;
		  	state.currentUser = data.currentUser;
		  	state.feedbacks = data.feedbacks;
		  	state.messages = data.messages;
		},
		switchStatus: (state, data) => {
     		data.feedback.isStatusPublic = data.status;
		},

		removeFeedback: ( state, index ) => {
			state.feedbacks.splice(index, 1);
		},

		addComment: (state, feedback) => {
			let comment = {
				  		id: state.currentUser.id,
				  		text: feedback.newComment,
				  		action: state.messages.reply,
				  		date: state.messages.justNow,
				  		user: 
					  		{	id: state.currentUser.id,
					  			fullName: state.currentUser.fullName,
					  			image: state.currentUser.image
					  		},
				  		hasChildren: false,
				  		children: []
				  	};

			if (feedback.replyTo == '') {
				feedback.comments.push(comment);
			}
			else
			{
				feedback.replyTo.comment.children.push(comment);
			}
			
		  	feedback.newComment = '';
		  	feedback.replyTo = '';
		},

		cancelReply: (state, feedback) => 
		{
			feedback.replyTo = '';
		}

	},
	getters: {
		feedbacks: state =>	{
			return state.feedbacks;
		},
		messages: state => {
			return state.messages;
		},
		currentUser: state => {
			return state.currentUser;
		}
	},
	modules: {}
});


export default store