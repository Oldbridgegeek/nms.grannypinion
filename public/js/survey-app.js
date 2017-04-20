window.onload = function () {
	var eventBus = new Vue();

	var surveySelectorComponent = Vue.component('survey-question-selector',{
		props: ['survey', 'surveyTypeList'],
		data: function(){
			return {
			};
		},
		mounted: function()
		{
		},
		template: `
		<div>
			<div class="form-group">
				<div class="col-md-5 col-md-offset-1">
                    <select class="form-control" v-model="survey.type">
                        <option v-for="item in surveyTypeList" :value="item.type">{{item.title}}</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" v-model="survey.value" :disabled="survey.type < 1">
                </div>
                <a href="#" v-on:click.prevent="$emit('remove')"><i class="glyphicon glyphicon-remove"></i></a>
			</div>
		</div>
		`,
		methods: {
		}
	});
	var survey = new Vue({
		el: '#survey',
		data: {
			title: '',
			description: '',
			surveys: [],
			// surveyQuestionsList: 'as'
			hasError: false
			
		},
		methods: {
			addSurvey: function()
			{
				this.surveys.push({type:0,value:''});
			},

			submit: function()
			{
				vm = this;
				axios.post('/survey/store', {
				    surveys: this.surveys,
				    title: this.title,
				    description: this.description
				  })
				  .then(function (response) {
				  	window.location = "/surveys";
				    // console.log(response.data);
				  })
				  .catch(function (error) {
				    vm.hasError = true;
				  });
			}
		},
		computed: {},
		created: function()
		{
			const vm = this;
			axios.get('/surveys/questions/list')
			  .then(function (response) {
			  	vm.surveyQuestionsList = response.data;
			  })
			  .catch(function (error) {
			    console.log(error);
			  });

		},
	});
}