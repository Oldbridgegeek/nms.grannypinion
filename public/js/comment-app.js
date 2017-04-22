window.onload = function () {
Vue.component('feedback',{
	template: '<p>{{"hi laravel"}}</p>'
});
new Vue({
	el: '#commentaries-app',
	data: {
		feedbacks: [
			{
				title: 'Lorem ipsum dolor sit.',
				content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae, autem!',
				date: '25 seconds ago',
				isAuthor: true,
				isStatusPublic: true

			}
		]
	},
});

}