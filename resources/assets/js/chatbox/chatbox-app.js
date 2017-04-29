import Vue from 'vue';
import Chatbox from './components/Chatbox.vue';
import axios from 'axios';

new Vue({
	el: '#chatbox',
	data: {
		currentUser: '',
		messages: [],
		pal: '',
		additionalInfo: ''
	},
	components: { Chatbox },
	
	created: function() {
		this.loadData();
		let roomID = this.getRoomID();
		window.Echo.join('chatbox')
	    .listen('MessageSent', (e) => {
	    	//only for Others and only in this!(roomID) room.
	    	if (e.user.id != this.currentUser.id && e.roomID == roomID) {
	    		if (e.user.avatar == null) {
	    			e.user.avatar = '/default/default.jpg';
	    		}
	    		let el = {
					text: e.message.message,
					user: {
						id: e.user.id,
						image: "/uploads/avatars/"+e.user.avatar
					}
				};
				this.messages.push(el);
				this.scrollToEnd(1000000000000);
	    	}
	        
	    });
		
		
	},
	methods: {
		loadData()
			{
				let vm = this;
				let roomID = vm.getRoomID();
				axios.get('/room/'+ roomID +'/getData')
				.then(function (response) {
					vm.currentUser = response.data.currentUser;
					vm.pal = response.data.pal;
					vm.messages = response.data.messages;
					vm.additionalInfo = response.data.additionalInfo;
					vm.scrollToEnd(1000000000000);
				})
				.catch(function (error) {
					console.log(error);
				});
			},

			addMessage(message)
			{
				let el = {
					text: message,
					user: {
						id: this.currentUser.id,
						image: this.currentUser.image
					}
				};
				let vm = this;
				let roomID = vm.getRoomID();
				axios.post('/room/'+ roomID +'/sendMessage', {
				    message: message,
				    user_id: vm.currentUser.id,
				    room_id: roomID,
				    pal_id: vm.pal.id
				  })
				  .then(function (response) {
				    
				  })
				  .catch(function (error) {
				    console.log(error);
				  });
					this.messages.push(el);
				
				this.scrollToEnd();

			},
		getRoomID: function()
	    {
	    	let first = $(location).attr('pathname');

			first.indexOf(1);

			first.toLowerCase();

			return first.split("/")[2];
	    },

	    scrollToEnd: function(number = 0) { 
			let $messages = $('.messages');  
	    	return $messages.animate({ scrollTop: $messages.prop('scrollHeight') + number }, 300);
	    },
		
	},
	computed: {
		
	}

});