import Vue from 'vue';
import Feedbacks from './containers/feedbacks.vue';
import store from './store.js';

new Vue({
	el: '#feedbacks-app',
	store,
	components: { Feedbacks },
	created: () => {
		store.dispatch('LOAD_FEEDBACKS_LIST');
		
	},
	computed: {
		feedbacksCount()
		{
			let count = 0;
			store.state.feedbacks.filter((item) => {
				if (item.isAuthor == true) {
					count++;
				}
				else if(item.isStatusPublic == true)
				{
					count++;
				}
			});
			return count;
			// return store.state.feedbacks.length;
		}
	}

});