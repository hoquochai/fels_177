var isFinish = [];
var isChoose = [];
var valueProgessBar = 30;
var currentNumberOfQuestion = 0;
var numberOfQuestion = $('input[name=numberOfQuestion]').val();
var messageRtn = JSON.parse($('input[name=message]').val());
var routeResult = $('input[name=routeResult]').val();
var routeSaveResult = $('input[name=routeSaveResult]').val();
var lessonId = $('input[name=lessonId]').val();
var score = 0;
var wordQuestions = [];
$(document).ready(function () {
    showQuestion(0);
    for (var index = 0; index < isChoose.length; index++) {
        $('input:radio[name="answer"][value=index]').attr('checked',true);
    }

    //$('input[type=radio][name=answer]').click(function () {
    //    console.log("action check");
    //    var number = $(this).attr('id');
    //    isFinish.push(number);
    //});

    //$('.action').click(function () {
    //    console.log("action click")
    //    var number = $(this).attr('id');
    //    if($('#' + number).is(':checked')) {
    //        isFinish.push(number);
    //    }
    //});

});

//$('input[type=radio][name=answer]').click(function () {
//    console.log("action check");
//    var number = $(this).attr('id');
//    isFinish.push(number);
//});


function saveAnswer(number, wordId) {
    console.log("action saveAnswer");
    console.log("wordId: "+wordId);
    if (isFinish.indexOf(number) == -1) {
        isFinish.push(number);
    }

    if (wordQuestions.indexOf(wordId) == -1) {
        wordQuestions.push(wordId);
    }

    id = $('input[type=radio][name=answer]:checked').attr('id');
    id = parseInt(id);
    console.log(id);
    if (isChoose.indexOf(id) == -1) {
        isChoose.push(id);
    }
}

function showQuestion(number) {
    console.log(number);
    console.log(isFinish);
    console.log(isChoose);
    console.log(arrayQuestionNotAnswer);



    /* init variable */
    var words = $('input[name=words]').val();
    var wordAnswers = $('input[name=wordAnswers]').val();

    var wordsJson = JSON.parse(words);
    var wordAnswersJson = JSON.parse(wordAnswers);
    var $wordIds = [];
    var $wordNames = [];
    var arrayQuestionNotAnswer = [];

    /* before show question */
    $('.result').html("");
    $('#question').html("");
    //$(".btn-miss").remove();
    number = parseInt(number);

    /* get id and name of word*/
    for (var key in wordsJson) {
        if (wordsJson.hasOwnProperty(key)){
            $wordIds.push(key);
            $wordNames.push(wordsJson[key]);
        }
    }
    $wordId = $wordIds[number];
    $wordName = $wordNames[number];

    /*init html text*/
    var html = "<h3><b><i>" + $wordName + "</i></b></h3><hr>" +
        "<div class='form-group'>";
    var htmlMiss = "";
    currentNumberOfQuestion = number + 1;
    handleProgress();

    /* Select answer */
    for(var i = 0; i < wordAnswersJson.length; i++) {
        if (wordAnswersJson[i].word_id == $wordId) {
            html += "<label>";
            html += "<input type='radio'" + ((isChoose.indexOf(wordAnswersJson[i].id) == -1) ? '' : 'checked') + " id='" +
                wordAnswersJson[i].id + "'  name='answer' value='" + wordAnswersJson[i].id + "' onclick='saveAnswer("+ number + ","+ $wordId +")'>" +
                "  " + wordAnswersJson[i].content + "</label><br>"
        }
    }

    html += "</div>";
    html += "<hr>";
    html += "<div class='btn-group'>";

    /* Button previous */
    if (number > 0) {
        if (number - 1 >= 0) {
            html += "<button class = 'btn btn-primary btn-previous' id='"+ number +"' onclick='showQuestion(" + (number - 1) + ")'>" +
                messageRtn.button_previous + "</button>";
        } else {
            html += "<button class = 'btn btn-primary btn-previous' id='"+ number +"' onclick='showQuestion(" + (number) + ")'>" +
                messageRtn.button_previous + "</button>";
        }
    }

    /* Button next */
    if (number < numberOfQuestion && number + 1 < numberOfQuestion) {
        //if (number + 1 < numberOfQuestion) {
            html += "<button class = 'btn btn-primary btn-next' id='"+ number +"' onclick='showQuestion(" + (number + 1) + ")'>" +
                messageRtn.btn_next + "</button>";
        //} else {
        //    html += "<button class = 'btn btn-primary' id='"+ number +"' onclick='showQuestion(" + (number) + ")'>" + messageRtn.btn_next + "</button>";
        //}
    }
    //else {
        console.log("arrayQuestionNotAnswer");
        for (var index = 0; index < number; index++) {
            if (isFinish.indexOf(index) == -1 && arrayQuestionNotAnswer.indexOf(index) == -1) {
                arrayQuestionNotAnswer.push(index);
            }
        }

        console.log("arrayQuestionNotAnswer: " + arrayQuestionNotAnswer);
        console.log("length: " + arrayQuestionNotAnswer.length);
        if (arrayQuestionNotAnswer.length > 5) {
            for (var index = 0; index < 5; index++) {
                htmlMiss += "<button class = 'btn btn-primary btn-xs btn-miss' id='"+ arrayQuestionNotAnswer[index] +"' onclick='showQuestion(" + (arrayQuestionNotAnswer[index]) + ")'>" +
                    messageRtn.btn_next + "<span class='badge'>" + (arrayQuestionNotAnswer[index] + 1) + "</span></button>";
            }
        } else {
            for (var index = 0; index < arrayQuestionNotAnswer.length; index++) {
                htmlMiss += "<button class = 'btn btn-primary btn-xs btn-miss' id='"+ arrayQuestionNotAnswer[index] +"' onclick='showQuestion(" + (arrayQuestionNotAnswer[index]) + ")'>" +
                    messageRtn.btn_next + "<span class='badge'>" + (arrayQuestionNotAnswer[index] + 1) + "</span></button>";
            }
        }
    //}



    /* Button finish */
    //if (number == numberOfQuestion) {
    //    html += "<button class = 'btn btn-primary' onclick='savePoint()'>" + messageRtn.btn_finish + "</button>";
    //}
    html += "</div>";
    //html += "<button class = 'btn btn-success submit' onclick = 'check(" + number +")'>" + messageRtn.btn_submit + "</button>";

    /* Button next */
    //if(number < numberOfQuestion && isFinish.indexOf(number) == -1) {
    //    console.log("isFinish: " + isFinish);
    //    console.log("number if: " + number);
    //    html += "<button class = 'btn btn-primary' onclick='showQuestion(" + (number + 1) + ")'>" + messageRtn.btn_next + "</button>";
    //} else {
    //    for (i = 0; i < numberOfQuestion; i++) {
    //        if(isFinish.indexOf(i) == -1) {
    //            number = i;
    //            i = numberOfQuestion;
    //        }
    //    }
    //    console.log("number else: " + number);
    //    console.log("isFinish: " + isFinish);
    //    if(number < numberOfQuestion) {
    //        console.log("number else if: " + number);
    //        html += "<button class = 'btn btn-primary' onclick='showQuestion(" + number + ")'>" + messageRtn.btn_next + "</button>";
    //    } else {
    //        html += "<button class = 'btn btn-primary' onclick='savePoint()'>" + messageRtn.btn_finish + "</button>";
    //    }
    //}
    //
    //html += "<input type='hidden' name='word' value='" + $wordId +"'>";
    $('#question').html(html);
    $('#question-miss').html(htmlMiss);
    //var numberChoose = isFinish.indexOf(number);
    //console.log(numberChoose);
    //if (numberChoose != -1) {
    //    console.log(isChoose[numberChoose]);
    //    $('.answer #' + isChoose[numberChoose]).attr('checked', true);
    //    $('.answer #' + isChoose[numberChoose]).css("background", "red");
    //}
}

//function check(number) {
//    valueProgessBar += 30;
//    handleProgress();
//    $('.answer').find('span').remove();
//    $('.submit').attr("disabled", true);
//    isFinish.push(number);
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
//
//            if (data.success == false) {
//                html = "<div class='alert alert-danger'>" + messageRtn.user_not_answer + "</div>";
//                $('.submit').attr("disabled", false);
//            } else {
//                var dataRtn = data.dataResult;
//                if (dataRtn.length == 1) {
//                    var idResult = dataRtn[0].id;
//                    var idChoice = $('input[name=answer]:checked').val();
//                    if (idResult == idChoice) {
//                        $('#' + idChoice).append("   <span class='glyphicon glyphicon-ok correct'></span>");
//                        html = "<label>" + messageRtn.answer_correct + "</label>";
//                    } else {
//                        score += 1;
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
//}

function handleProgress() {
    $( "#progeessdetail" ).html(messageRtn.progress_lesson +
        " <span class='badge'>" + currentNumberOfQuestion + "/" + numberOfQuestion + "</span>");
}

//function savePoint() {
//    $.ajax({
//        url: routeSaveResult,
//        type: 'put',
//        data: {
//            'point': score,
//            '_token': $('input[name=_token]').val(),
//        },
//        success: function (data) {
//            var html = "";
//            if (data.success == false) {
//                html = "<div class='alert alert-danger'>" + messageRtn.score_fail + "</div>";
//                $('.result').html(html);
//            } else {
//                window.location.href = routeResult;
//            }
//        }
//    });
//}

function submitLesson() {
    $('.btn-previous').attr("disabled", true);
    $('.btn-next').attr("disabled", true);
    $('.btn-miss').attr("disabled", true);
    $.ajax({
        url: $('input[name=route]').val(),
        type: 'post',
        data: {
            'questions': wordQuestions,
            '_token': $('input[name=_token]').val(),
            'answers': isChoose,
            'lessonId' : lessonId
        },
        success: function (data) {
            if (data.success == false) {
                html = "<div class='alert alert-danger'>" + messageRtn.score_fail + "</div>";
                $('.result').html(html);
            } else {
                window.location.href = routeResult;
            }
        }
    });
}


