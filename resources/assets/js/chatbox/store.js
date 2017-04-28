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
		
	},
	actions: {
		LOAD_DATA: function ({ commit }) {
			
	      store.dispatch('getRoomID').then(function(roomID){
	      		axios.get('/room/'+ roomID +'/getData')
	      			.then((response) => {
				        commit('SET_DATA', response.data)
				      }, (err) => {
				        console.log(err)
				      })
	      });
	    },

	    getRoomID: function()
	    {
	    	let first = $(location).attr('pathname');

			first.indexOf(1);

			first.toLowerCase();

			return first.split("/")[2];
	    },

	    addMessage: (context, message) => {
	    	store.dispatch('getRoomID').then(function(roomID){
	    		axios.post('/room/'+ roomID +'/sendMessage', {
				    message: message,
				    user_id: context.state.currentUser.id,
				    room_id: roomID,
				    pal_id: context.state.pal.id
				})
				.then(function (response) {
				    context.commit('addMessage',message);
				    
				})
				.catch(function (error) {
				    console.log(error);
				});
	    	});
			
	    }
	},
	mutations: {
		SET_DATA: (state, data) => {
			state.currentUser = data.currentUser;
			state.pal = data.pal;
			state.messages = data.messages;
			state.additionalInfo = data.additionalInfo;
		},
	
		addMessage: (state, message) => {
			let el = {
				text: message,
				user: {
					id: state.currentUser.id,
					image: state.currentUser.image
				}
			};
			state.messages.push(el);

		},
	},
	getters: {
		pal: state => {
			return state.pal;
		},

		currentUser: state => {
			return state.currentUser;
		},

		messages: state => {
			return state.messages;
		},

		additionalInfo: state => {
			return state.additionalInfo;
		},
	},
});


export default store