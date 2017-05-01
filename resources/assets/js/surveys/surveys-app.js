import Vue from 'vue';
import store from './store.js';
import questions from './components/Questions';
import { mapState } from 'vuex';


new Vue({
		el: '#survey',
		data: {
			title: '',
			description: ''
		},
		store,
		components: {questions},
		methods: {

			addSurvey: function()
			{
				store.dispatch('addQuestion');
			},

			submit: function()
			{
				store.dispatch('submit',{
					title: this.title,
					description: this.description
				});
			}
		},
		computed: mapState(['surveys','hasError','hasError','surveyQuestionsList']),
		
		created: () => {
			store.dispatch('loadQuestions');
		},
	});


	
	