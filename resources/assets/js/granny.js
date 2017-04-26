import Vue from 'vue';
import Feedbacks from './containers/feedbacks.vue';
import store from './store.js';

new Vue({
	el: '#feedbacks-app',
	store,
	components: { Feedbacks },

});