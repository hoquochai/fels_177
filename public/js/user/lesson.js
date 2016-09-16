$(document).ready(function () {
    showQuestion(0);
    //words =  $('input[name=words]').val();
    //wordAnswers =  $('input[name=wordAnswers]').val();
    //console.log(words);
    //console.log(wordAnswers);
    //var wordAnswersParse = JSON.parse(wordAnswers);
    //console.log(wordAnswersParse);
    //var result = JSON.parse(words);
    //var index = 0;
    //$.each(result, function(key, value){
    //    console.log(index);
    //    console.log(key);
    //    console.log(value);
    //    index ++;
    //});
    //
    //for(var i = 0; i < wordAnswersParse.length; i++) {
    //    console.log(wordAnswersParse[i]);
    //    console.log(wordAnswersParse[i].id);
    //}

    //showQuestion(words, wordAnswers, 1);


     //$('.submit').click(function () {
     //    alert("go");
     //    $('.answer').find('span').remove();
     //    $(this).attr("disabled", true);
     //    $.ajax({
     //        url: $('input[name=route]').val(),
     //        type: 'post',
     //        data: {
     //            'choice': $('input[name=answer]:checked').val(),
     //            '_token': $('input[name=_token]').val(),
     //            'word': $('input[name=word]').val()
     //        },
     //        success: function (data) {
     //            var html = "";
     //            var messageRtn = JSON.parse($('input[name=message]').val());
     //            if (data.success == false) {
     //                html = "<div class='alert alert-danger'>" + messageRtn.user_not_answer + "</div>";
     //            } else {
     //                var dataRtn = data.dataResult;
     //                if (dataRtn.length == 1) {
     //                    var idResult = dataRtn[0].id;
     //                    var idChoice = $('input[name=answer]:checked').val();
     //                    if (idResult == idChoice) {
     //                        $('#' + idChoice).append("   <span class='glyphicon glyphicon-ok correct'></span>");
     //                        html = "<label>" + messageRtn.answer_correct + "</label>";
     //                    } else {
     //                        $('#' + idChoice).append("   <span class='glyphicon glyphicon-remove incorrect'></span>");
     //                        html = "<label>" + messageRtn.answer_incorrect + "</label><br>" +
     //                            "<label>" + messageRtn.confirm_view_result + "<button class='btn btn-primary btn-xs' onClick='showResult(" + idResult + ")'>" +
     //                            messageRtn.button_view_result + "</button></label>";
     //                    }
     //                } else {
     //                    html = "<div class='alert alert-info'>" + messageRtn.question_not_answer + "</div>";
     //                }
     //            }
     //
     //            $('.result').html(html);
     //        }
     //    });
     //});

     $('input[type=radio][name=answer]').click(function () {
         $('.answer').find('span').remove()
     });
});
var isFinish = [];

function showResult(id) {
    $('.answer').find('span').remove();
    $('#' + id).append("   <span class='glyphicon glyphicon-ok correct'></span>");
}

function showQuestion(number) {
    console.log(isFinish);
    $('.result').html("");
    $('#question').html("");
    var words = $('input[name=words]').val();
    var wordAnswers = $('input[name=wordAnswers]').val();
    console.log("go");
    number = parseInt(number);
    console.log(number);
    console.log(words);
    var wordsJson = JSON.parse(words);
    console.log(wordsJson);
    var wordAnswersJson = JSON.parse(wordAnswers);
    var index = 1;
    var $wordId = 0;
    var $wordName = "";
    j = 1;
    var $wordIds = [];
    var $wordNames = [];
    for (var key in wordsJson) {
        if (wordsJson.hasOwnProperty(key)){
            $wordIds.push(key);
            $wordNames.push(wordsJson[key]);
        }
        //if (j == number) {
        //    $wordId = key;
        //    $wordName = wordsJson[key];
        ////console.log(j);
        ////console.log(key);
        ////console.log(wordsJson[key]);
        //} else {
        //    j++;
        //}

    }

    console.log($wordIds);
    console.log($wordNames);
    $wordId = $wordIds[number];
    $wordName = $wordNames[number];
    //$.each(wordsJson, function(key, value){
    //    console.log(index);
    //    if (index == number) {
    //        $wordId = key;
    //        $wordName = value;
    //    } else {
    //        index += 1;
    //    }
    //});
    var html = "<h3><b><i>" + $wordName + "</i></b></h3><hr>" +
        "<div class='form-group'>";
    for(var i = 0; i < wordAnswersJson.length; i++) {
        if (wordAnswersJson[i].word_id == $wordId) {
            html += "<label class='answer' id='" + wordAnswersJson[i].id + "'>";
            html += "<input type='radio' name='answer' value='" + wordAnswersJson[i].id + "'>  " + wordAnswersJson[i].content + "</label><br>"
        }
    }
    console.log(number);
    console.log(words);
    console.log(wordAnswers);
    html += "</div>";
    html += "<hr>";
    html += "<button class = 'btn btn-success' onclick = 'check(" + number +")'>Submit</button>";
if(number < 2 && isFinish.indexOf(number) == -1) {
    console.log("number if: " + number);
    html += "<button class = 'btn btn-primary' onclick='showQuestion(" + (number + 1) + ")'>Next</button>";
} else {
    for (i = 0; i < number; i++) {
        if(isFinish.indexOf(i) == -1) {
            var tmp = number;
            number = i;
            i = tmp;
        }
    }
    console.log("number else: " + number);
    if(number < 3) {
        html += "<button class = 'btn btn-primary' onclick='showQuestion(" + number + ")'>Next</button>";
    }

    //number = 0;
    //while (!isSubmit.contains(number)) {
    //    html += "<button class = 'btn btn-primary' onclick='showQuestion(" + (number + 1) + ")'>Next</button>";
    //}



}


    html += "<input type='hidden' name='word' value='" + $wordId +"'>";
    console.log(html);
    $('#question').html(html);
}

function check(number) {
    $('.answer').find('span').remove();
    $(this).attr("disabled", true);
    isFinish.push(number);
    $.ajax({
        url: $('input[name=route]').val(),
        type: 'post',
        data: {
            'choice': $('input[name=answer]:checked').val(),
            '_token': $('input[name=_token]').val(),
            'word': $('input[name=word]').val()
        },
        success: function (data) {
            var html = "";
            var messageRtn = JSON.parse($('input[name=message]').val());
            if (data.success == false) {
                html = "<div class='alert alert-danger'>" + messageRtn.user_not_answer + "</div>";
            } else {
                var dataRtn = data.dataResult;
                if (dataRtn.length == 1) {
                    var idResult = dataRtn[0].id;
                    var idChoice = $('input[name=answer]:checked').val();
                    if (idResult == idChoice) {
                        $('#' + idChoice).append("   <span class='glyphicon glyphicon-ok correct'></span>");
                        html = "<label>" + messageRtn.answer_correct + "</label>";
                    } else {
                        $('#' + idChoice).append("   <span class='glyphicon glyphicon-remove incorrect'></span>");
                        html = "<label>" + messageRtn.answer_incorrect + "</label><br>" +
                            "<label>" + messageRtn.confirm_view_result + "<button class='btn btn-primary btn-xs' onClick='showResult(" + idResult + ")'>" +
                            messageRtn.button_view_result + "</button></label>";
                    }
                } else {
                    html = "<div class='alert alert-info'>" + messageRtn.question_not_answer + "</div>";
                }
            }

            $('.result').html(html);
        }
    });
}

