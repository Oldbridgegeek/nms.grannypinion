@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @if(Auth::check())
        <div class="col-md-10 col-md-offset-2">
            @if(Auth::user()->id != $user->id)
            <div class="col-md-7">
                <h3> Anonymes Feedback für {{$user->firstname}} {{$user->lastname}} </h3>
            </div>
            <div class="col-md-3">
                <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px;height:150px; float:left; border-radius:50%; margin-right:25px">
                </img>
            </div>
            <button id="feedbackTextOnly"> Ich möchte nur einen Feedback Text schreiben.</button>
            <p style="color:red;">* Mindestens ein Feld muss ausgefüllt werden.</p>
            <form class="form-horizontal" role="form" method="POST" action="/feedback">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                <input type="hidden" name="subject_id" id="subject_id" value="{{ Auth::user()->id}}">
                <div id="starRating">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="starsHonesty" class="control-label">Ehrlichkeit</label>
                            <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsHonesty" id="starsHonesty">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" onchange="toggleCheckbox(this,'starsHonesty')" id="starsHonesty"> Keine Angabe<br>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="starsAttractiveness" class="control-label">Attraktivität</label>
                            <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsAttractiveness" id="starsAttractiveness">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" id="checkAttractiveness" onchange="toggleCheckbox(this,'starsAttractiveness')"> Keine Angabe<br>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="starsReliability" class="control-label">Zuverlässigkeit</label>
                            <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsReliability" id="starsReliability">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" id="checkReliability" onchange="toggleCheckbox(this,'starsReliability')"> Keine Angabe<br>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="starsFun" class="control-label">Witzigkeit und Spaß</label>
                            <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsFun" id="starsFun">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" id="checkFun" onchange="toggleCheckbox(this,'starsFun')"> Keine Angabe<br>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="starsIntelligence" class="control-label">Intelligenz</label>
                            <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsIntelligence" id="starsIntelligence">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" id="checkIntelligence" onchange="toggleCheckbox(this,'starsIntelligence')"> Keine Angabe<br>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="starsKindness" class="control-label">Freundlichkeit</label>
                            <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsKindness" id="starsKindness">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" id="checkKindness" onchange="toggleCheckbox(this,'starsKindness')"> Keine Angabe<br>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="starsAverage" class="control-label">Gesamteindruck</label>
                            <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsAverage" id="starsAverage">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" id="checkAverage" onchange="toggleCheckbox(this,'starsAverage')"> Keine Angabe<br>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="feedback" class="control-label">Feedback</label>
                        <textarea class="form-control" rows="5" name="feedback" id="feedback"></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" id="checkFeedback" onchange="toggleCheckbox(this,'feedback')"> Keine Angabe<br>
                </div>
                <div class="col-md-10">
                    <button type="submit" class="btn btn-primary"> Bestätigen </button>
                </div>
            </div>
        </form>
    </div>
    @else
    <h2>Du darfst dich selber nicht bewerten.</h2>
    @endif
</div>
@else
<div class="col-md-10 col-md-offset-2">
    <div class="col-md-7">
        <h3> Anonymes Feedback für {{$user->firstname}} {{$user->lastname}} </h3>
    </div>
    <div class="col-md-3">
        <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px;height:150px; float:left; border-radius:50%; margin-right:25px">
        </img>
    </div>
    <button id="feedbackTextOnly"> Ich möchte nur einen Feedback Text schreiben.</button>
    <p style="color:red;">* Mindestens ein Feld muss ausgefüllt werden.</p>
    <form class="form-horizontal" role="form" method="POST" action="/feedback">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
        <input type="hidden" name="subject_id" id="subject_id" value="0">
        <div id="starRating">
            <div class="col-md-7">
                <div class="form-group">
                    <label for="starsHonesty" class="control-label">Ehrlichkeit</label>
                    <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsHonesty" id="starsHonesty">
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" onchange="toggleCheckbox(this,'starsHonesty')" id="starsHonesty"> Keine Angabe<br>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label for="starsAttractiveness" class="control-label">Attraktivität</label>
                    <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsAttractiveness" id="starsAttractiveness">
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkAttractiveness" onchange="toggleCheckbox(this,'starsAttractiveness')"> Keine Angabe<br>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label for="starsReliability" class="control-label">Zuverlässigkeit</label>
                    <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsReliability" id="starsReliability">
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkReliability" onchange="toggleCheckbox(this,'starsReliability')"> Keine Angabe<br>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label for="starsFun" class="control-label">Witzigkeit und Spaß</label>
                    <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsFun" id="starsFun">
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkFun" onchange="toggleCheckbox(this,'starsFun')"> Keine Angabe<br>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label for="starsIntelligence" class="control-label">Intelligenz</label>
                    <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsIntelligence" id="starsIntelligence">
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkIntelligence" onchange="toggleCheckbox(this,'starsIntelligence')"> Keine Angabe<br>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label for="starsKindness" class="control-label">Freundlichkeit</label>
                    <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsKindness" id="starsKindness">
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkKindness" onchange="toggleCheckbox(this,'starsKindness')"> Keine Angabe<br>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label for="starsAverage" class="control-label">Gesamteindruck</label>
                    <input class="form-control" placeholder="Wert von 1 bis 10" type="number" name="starsAverage" id="starsAverage">
                </div>
            </div>
            <div class="col-md-3">
                <input type="checkbox" id="checkAverage" onchange="toggleCheckbox(this,'starsAverage')"> Keine Angabe<br>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                <label for="feedback" class="control-label">Feedback</label>
                <textarea class="form-control" rows="5" name="feedback" id="feedback"></textarea>
            </div>
        </div>
        <div class="col-md-3">
            <input type="checkbox" id="checkFeedback" onchange="toggleCheckbox(this,'feedback')"> Keine Angabe<br>
        </div>
        <div class="col-md-10">
            <button type="submit" class="btn btn-primary"> Bestätigen </button>
        </div>
    </div>
</form>
</div>
@endif
</div>
@endsection