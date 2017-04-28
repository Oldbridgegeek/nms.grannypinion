<template>
<div>
	<div class="form-group">
		<div class="col-md-5 col-md-offset-1">
            <select class="form-control" v-model="survey.type">
             <!--  -->
                <option v-for="item in surveyTypeList" :value="item.type">{{item.title}}</option>
            </select>
        </div>
        <div class="col-md-5">
        <!--  -->
            <input type="text" class="form-control" v-model="survey.value" :disabled="survey.type < 1">
        </div>
        <a href="#" v-on:click.prevent="$emit('remove')"><i class="glyphicon glyphicon-remove"></i></a>
	</div>
</div>	
</template>

<script>
	export default
	{
		name: 'questions',
		props: ['survey','surveyTypeList'],
		computed: 
		{
		},

	}
</script>

<style>
	
</style>