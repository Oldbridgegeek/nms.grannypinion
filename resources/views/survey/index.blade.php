@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">{{ trans('app.my_surveys') }}</div>
                <div class="span5">
                    <table class="table table-striped table-condensed">
                    <thead>
                      <tr>
                          <th>#</th>
                          <th>{{ trans('app.survey_title') }}</th>
                          <th>{{ trans('app.created') }}</th>
                          <th>{{ trans('app.answers') }}</th> 
                          <th>{{ trans('app.actions') }}</th>                                         
                      </tr>
                  </thead>   
                  <tbody>
                @forelse($surveys as $survey)
                    {{-- <div class="panel-body"> --}}
                        <tr>
                            <td>{{$survey->id}}</td>
                            <td>{{$survey->title}}</td>
                            <td>{{$survey->created_at->diffForHumans()}}</td>
                            <td>{{count($survey->answers())}}</td>
                            <td>
                                <ul class="survey-actions" style="padding-left:0px;">
                                    <li>
                                        <a title="Details" href="{{route('survey.show', ['survey' => $survey] )}}"> <i class="glyphicon glyphicon-eye-open"></i> </a>
                                    </li>
                                    <li>
                                        {{ Form::open(['method' => 'DELETE', 'route' => ['survey.delete', $survey->id]]) }}
                                        <button onclick="return confirm('Are you sure?')"  class="empty-button" type="submit"><i class="glyphicon glyphicon-remove"></i></button>
                                        {{ Form::close() }}
                                    </form>
                                    </li>
                                </ul>
                            </td>                                       
                        </tr>
                    {{-- </div> --}}
                    @empty
                    <br>
                    <p class="alert alert-info">{{ trans('app.no_surveys') }}</p>
                @endforelse
                    </tbody>
                </table>
              </div>
            </div>

            <a href="{{route('survey.create')}}" class="btn btn-success btn-md" style="display: block; width: 100%;"> {{ trans('app.survey_create') }} </a>
        </div>
    </div>
</div>
@endif
@endsection