@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" id="survey">
                <div class="panel-heading" style="text-align: center;">Create anonymous survey</div>
                <div class="panel-body">
                    <div class="alert alert-danger" v-if="hasError">
                            Please fill out <b>all</b> the inputs to proceed.
                    </div>
                    <form @submit.prevent="submit" class="form-horizontal" role="form" method="POST" action="{{ route('survey.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name for your Survey</label>

                            <div class="col-md-8">
                                <input id="name" v-model="title" type="text" class="form-control" name="title">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="text" class="col-md-4 control-label">What do you want to know from your friends?</label>

                            <div class="col-md-8">
                                <textarea v-model="description" class="form-control" rows="10" name="description" id="text"></textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <a href="#" class="btn btn-success" @click.prevent="addSurvey">Add Specific Question</a>
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                        
                            <survey-question-selector 
                                v-for="(survey, index) in surveys" 
                                :survey="survey"
                                :survey-type-list="surveyQuestionsList"
                                v-on:remove="surveys.splice(index, 1)">
                                
                            </survey-question-selector >
                        </div>
                    

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" >
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
