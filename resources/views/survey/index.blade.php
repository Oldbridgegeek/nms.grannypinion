@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">My surveys</div>
                @forelse($surveys as $survey)
                    <div class="panel-body">
                        <div class="col-md-5">
                            {{$survey->title}}
                        </div>
                        <div class="col-md-5">
                            {{$survey->created_at->diffForHumans()}}
                        </div>
                        <div class="col-md-2">
                            <ul class="survey-actions">
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
                        </div>
                    </div>
                    @empty
                    <br>
                    <p class="alert alert-info">No surveys created</p>
                @endforelse
            </div>

            <a href="{{route('survey.create')}}" class="btn btn-success btn-md" style="display: block; width: 100%;"> Create survey </a>
        </div>
    </div>
</div>
@endif
@endsection