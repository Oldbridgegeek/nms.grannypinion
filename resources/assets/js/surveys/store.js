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
		// title: '',
		// description: '',
		surveys: [],
		surveyQuestionsList: '',
		hasError: false
	},
	actions: {
		loadQuestions: function ({ commit }) {
	      	axios.get('/surveys/questions/list').then((response) => {
		        commit('setQuestionsList', response.data)
		    }, (err) => {
		        console.log(err)
		    })
	    },
	    addQuestion: ( {commit} ) => {
	    	commit('addQuestion');
	    },
	    submit: (context, data) => {
			axios.post('/survey/store', {
			    surveys: context.state.surveys,
			    title: data.title,
			    description: data.description
			  })
			  .then(function (response) {
			  	window.location = "/surveys";
			    // console.log(response.data);
			  })
			  .catch(function (error) {
			     context.state.hasError = true;
			  });
	    }
	},
	mutations: {
		setQuestionsList: (state, data) => {
			state.surveyQuestionsList = data;
		},
		addQuestion: (state) => {
			state.surveys.push({type:0,value:''});
		}
	},
	getters: {}

});
export default store