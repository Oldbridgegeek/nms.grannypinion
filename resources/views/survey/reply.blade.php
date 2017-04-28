@extends('layouts.app')
{{-- 
@section('custom-js')
<script src="/js/rating-app.js"></script>
@endsection --}}


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
                    A friend wants to know your anonymous opinion.
                </div>
                <div class="panel-body">
                    {{$survey->description}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Be honest, you'll stay anonymous.
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{route('reply.store')}}">
                {{ csrf_field() }}
                        <input type="hidden" value="{{$survey->id}}" name="survey_id">
                        <div class="alert alert-info">You are free to leave any of the questions blank, so you answer will be - <i>not specified</i></div>
                        <div class="alert">
                        @forelse($survey->questions as $question)
                            @if($question->isStarRating())
                                <div class="form-group">
                                    <label>{{$question->title}}</label>
                                    <div class="rateYo"></div>
                                    <input type="hidden" name="{{$question->id}}">
                                    <input type="hidden" class="my-rating" value="0" name="{{$question->id}}">
                                </div>
                            @elseif($question->isTextInput())
                                <div class="form-group">
                                    <label>{{$question->title}}</label>
                                    <input type="hidden" name="{{$question->id}}">
                                    <input name="{{$question->id}}" type="text" class="form-control">
                                </div>   
                            @elseif($question->isTextArea())
                                <div class="form-group">
                                    <label>{{$question->title}}</label>
                                    <input type="hidden" name="{{$question->id}}">
                                    <textarea class="form-control" name="{{$question->id}}"></textarea>
                                </div>   
                            @endif
                             
                        @empty

                        @endforelse
                        </div>

                        <button type="submit" class="btn btn-success btn-md"> Reply anonymously </button>
                    </form>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
@endsection

@section('customJS')
<script>
    $(document).ready(function(){
      $(".rateYo").rateYo({
         precision: 1,
         starWidth: "25px",
         spacing: "3px",
         halfStar: true
      })
      .on("rateyo.set", function (e, data) {
        // var formGroup = ;
        // console.log(formGroup.val);return;
        $(this).closest('.form-group').children('.my-rating').val(data.rating);
         // $('.my-rating').val();
      });
    })
</script>
@endsection