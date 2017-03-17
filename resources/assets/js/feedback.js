<script>
            window.onload = function(){ 
            var visible = true;
            document.getElementById('feedbackTextOnly').onclick = function(event){
                if(visible == true){
                    document.getElementById('starRating').style.visibility = 'hidden';
                    document.getElementById('feedbackTextOnly').innerHTML = "Ich möchte eine Feedback Hilfe";
                    visible = false;
                    var children = document.getElementsByClassName('form-control');
                    for (var i=0; i<children.length ; i++){
                        var ratingChild = children[i];
                        ratingChild.value = "";
                    }
                    var children = document.getElementsByClassName('rating');
                    for (var i=0; i<children.length ; i++){
                        var ratingChild = children[i];
                        ratingChild.style.visibility = hidden;
                    }
                }
                else {
                    document.getElementById('starRating').style.visibility = 'visible';
                    document.getElementById('feedbackTextOnly').innerHTML = "Ich möchte nur einen Feedback Text schreiben.";
                    visible = true;
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
        }
</script>