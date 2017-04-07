@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @if(Auth::check())
        @if(Auth::user()->id != $user->id)
        <div class="col-md-10 col-md-offset-2" style="margin-bottom:2em;">
            <div class="row">
                <div class="col-md-3">
                    <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px;height:150px; float:left; border-radius:0%; margin-right:25px; border: solid; border-width:0.5px; border-color: grey;">
                    </img>
                </div>
                <div class="col-md-6">
                    <h3> Anonymous Feedback for {{$user->firstname}} {{$user->lastname}} </h3>
                    <button id="feedbackTextOnly"> I just want to write a Feedback Text.</button>
                    <p style="color:red;">* At least one field is required.</p>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-2">
            <form class="form-horizontal" role="form" method="POST" action="/feedback" style="margin-top:2em;">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                <input type="hidden" name="subject_id" id="subject_id" value="{{ Auth::user()->id}}">
        <div id="starRating">


            <div class="col-md-7">
                <div class="col-md-3">
                <div class="form-group">
                    <label for="starsHonesty" class="control-label" name="starsHonesty" >Honesty</label>
                </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="starsHonesty" id="starsHonesty" />
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" onchange="toggleCheckbox(this,'starsHonesty')" id="starsHonesty"> No specification<br>
            </div>


            <div class="col-md-7">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="starsAttractiveness" class="control-label">Attraktivität</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="starsAttractiveness" id="starsAttractiveness"/>
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkAttractiveness" onchange="toggleCheckbox(this,'starsAttractiveness')"> Keine Angabe<br>
            </div>

            <div class="col-md-7">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="checkReliability" class="control-label">Zuverlässigkeit</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="checkReliability" id="checkReliability"/>
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkReliability" onchange="toggleCheckbox(this,'checkReliability')"> Keine Angabe<br>
            </div>

            <div class="col-md-7">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="starsFun" class="control-label">Witzigkeit und Spaß</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="starsFun" id="starsFun"/>
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkFun" onchange="toggleCheckbox(this,'starsFun')"> Keine Angabe<br>
            </div>

            <div class="col-md-7">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="starsIntelligence" class="control-label">Intelligenz</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="starsIntelligence" id="starsIntelligence"/>
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkIntelligence" onchange="toggleCheckbox(this,'starsIntelligence')"> Keine Angabe<br>
            </div>

            <div class="col-md-7">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="starsKindness" class="control-label">Freundlichkeit</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="starsKindness" id="starsKindness"/>
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkKindness" onchange="toggleCheckbox(this,'starsKindness')"> Keine Angabe<br>
            </div>

            <div class="col-md-7">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="checkAverage" class="control-label">Insgesamt</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="checkAverage" id="checkAverage"/>
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkAverage" onchange="toggleCheckbox(this,'checkAverage')"> Keine Angabe<br>
            </div>
        </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="feedback" class="control-label">Feedback</label>
                        <textarea class="form-control" rows="5" name="feedback" id="feedback"></textarea>
                    </div>
                </div>
                <div class="col-md-10">
                    <button type="submit" class="btn btn-primary"> Submit</button>
                </div>
            </div>
        </form>
    </div>
    <script>
    var visible = true;
    document.getElementById('feedbackTextOnly').onclick = function(event){
        if(visible == true){
            var starsRating = document.getElementsByClassName('rating');
            for(var i=0; i < starsRating.length; i++) {
                var starRating = starsRating[i];
                starRating.disabled = true;
            }
            document.getElementById('feedbackTextOnly').innerHTML = "I need help with the feedback";
            visible = false;

            var el = document.getElementsByTagName('input');
            for (var i = 0; i < el.length; i++) {
                // if input element is checkbox
                if (el[i].type === 'checkbox') {
                // toggle or clear checkbox state
                    if (el[i].checked) {
                    }
                    else {
                        el[i].checked = true;
                    }
                }
            }


        }
        else {
            var starsRating = document.getElementsByClassName('rating');
            for(var i=0; i < starsRating.length; i++) {
                var starRating = starsRating[i];
                starRating.disabled = false;
            }
            document.getElementById('feedbackTextOnly').innerHTML = "I just want to write a feedback text.";
            visible = true;
            var el = document.getElementsByTagName('input');
            for (var i = 0; i < el.length; i++) {
                // if input element is checkbox
                if (el[i].type === 'checkbox') {
                // toggle or clear checkbox state
                    if (el[i].checked) {
                        el[i].checked = false;
                    }
                    else {
    
                    }
                }
            }
        }
    }

    function toggleCheckbox(element, idStars)
    {
        if(element.checked == true){
            document.getElementById(idStars).disabled = true;
            document.getElementById(idStars).style.textDecoration = "overline";
            document.getElementById(idStars).value = "";
        }
        if(element.checked == false){
            document.getElementById(idStars).disabled = false;
        }
    }
    
    </script>
    @else
    <div class="col-md-6 col-md-offset-3" style="margin-top: 3em;margin-bottom: 3em;">
    <h2>You are not allowd to write yourself a feedback.</h2>
    </div>
    @endif
</div>
@else
<div class="col-md-10 col-md-offset-2" style="margin-bottom:2em;">
    <div class="row">
        <div class="col-md-3">
            <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px;height:150px; float:left; border-radius:0%; margin-right:25px; border: solid; border-width:0.5px; border-color: grey;">
            </img>
        </div>
        <div class="col-md-6">
            <h3> Anonymous Feedback for {{$user->firstname}} {{$user->lastname}} </h3>
            <button id="feedbackTextOnly"> I just want to write a Feedback Text.</button>
            <p style="color:red;">* At least one field is required.</p>
        </div>
    </div>
</div>
<div class="col-md-10 col-md-offset-2">
    <form class="form-horizontal" role="form" method="POST" action="/feedback">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
        <input type="hidden" name="subject_id" id="subject_id" value="0">
        <div id="starRating">


            <div class="col-md-7">
                <div class="col-md-3">
                <div class="form-group">
                    <label for="starsHonesty" class="control-label" name="starsHonesty" >Ehrlichkeit</label>
                </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="starsHonesty" id="starsHonesty" />
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" onchange="toggleCheckbox(this,'starsHonesty')" id="starsHonesty"> Keine Angabe<br>
            </div>


            <div class="col-md-7">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="starsAttractiveness" class="control-label">Attraktivität</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="starsAttractiveness" id="starsAttractiveness"/>
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkAttractiveness" onchange="toggleCheckbox(this,'starsAttractiveness')"> Keine Angabe<br>
            </div>

            <div class="col-md-7">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="checkReliability" class="control-label">Zuverlässigkeit</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="checkReliability" id="checkReliability"/>
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkReliability" onchange="toggleCheckbox(this,'checkReliability')"> Keine Angabe<br>
            </div>

            <div class="col-md-7">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="starsFun" class="control-label">Witzigkeit und Spaß</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="starsFun" id="starsFun"/>
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkFun" onchange="toggleCheckbox(this,'starsFun')"> Keine Angabe<br>
            </div>

            <div class="col-md-7">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="starsIntelligence" class="control-label">Intelligenz</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="starsIntelligence" id="starsIntelligence"/>
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkIntelligence" onchange="toggleCheckbox(this,'starsIntelligence')"> Keine Angabe<br>
            </div>

            <div class="col-md-7">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="starsKindness" class="control-label">Freundlichkeit</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="starsKindness" id="starsKindness"/>
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkKindness" onchange="toggleCheckbox(this,'starsKindness')"> Keine Angabe<br>
            </div>

            <div class="col-md-7">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="checkAverage" class="control-label">Insgesamt</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="rating" name="checkAverage" id="checkAverage"/>
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkAverage" onchange="toggleCheckbox(this,'checkAverage')"> Keine Angabe<br>
            </div>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <label for="feedback" class="control-label">Feedback</label>
                <textarea class="form-control" rows="5" name="feedback" id="feedback"></textarea>
            </div>
        </div>
        <div class="col-md-10">
            <button type="submit" class="btn btn-primary"> Submit </button>
        </div>
    </div>
</form>
</div>
<script>
    var visible = true;
    document.getElementById('feedbackTextOnly').onclick = function(event){
        if(visible == true){
            var starsRating = document.getElementsByClassName('rating');
            for(var i=0; i < starsRating.length; i++) {
                var starRating = starsRating[i];
                starRating.disabled = true;
            }
            document.getElementById('feedbackTextOnly').innerHTML = "I need help for the Feedback.";
            visible = false;

            var el = document.getElementsByTagName('input');
            for (var i = 0; i < el.length; i++) {
                // if input element is checkbox
                if (el[i].type === 'checkbox') {
                // toggle or clear checkbox state
                    if (el[i].checked) {
                    }
                    else {
                        el[i].checked = true;
                    }
                }
            }


        }
        else {
            var starsRating = document.getElementsByClassName('rating');
            for(var i=0; i < starsRating.length; i++) {
                var starRating = starsRating[i];
                starRating.disabled = false;
            }
            document.getElementById('feedbackTextOnly').innerHTML = "I just want to write a Feedback Text.";
            visible = true;
            var el = document.getElementsByTagName('input');
            for (var i = 0; i < el.length; i++) {
                // if input element is checkbox
                if (el[i].type === 'checkbox') {
                // toggle or clear checkbox state
                    if (el[i].checked) {
                        el[i].checked = false;
                    }
                    else {
    
                    }
                }
            }
        }
    }

    function toggleCheckbox(element, idStars)
    {
        if(element.checked == true){
            document.getElementById(idStars).disabled = true;
            document.getElementById(idStars).style.textDecoration = "overline";
            document.getElementById(idStars).value = "";
        }
        if(element.checked == false){
            document.getElementById(idStars).disabled = false;
        }
    }
    
</script>
@endif
</div>
@endsection