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
});

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
        html += "<button class = 'btn btn-primary btn-next' id='"+ number +"' onclick='showQuestion(" + (number + 1) + ")'>" +
            messageRtn.btn_next + "</button>";
    }
    for (var index = 0; index < number; index++) {
        if (isFinish.indexOf(index) == -1 && arrayQuestionNotAnswer.indexOf(index) == -1) {
            arrayQuestionNotAnswer.push(index);
        }
    }

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

    html += "</div>";
    $('#question').html(html);
    $('#question-miss').html(htmlMiss);
}

function handleProgress() {
    $( "#progeessdetail" ).html(messageRtn.progress_lesson +
        " <span class='badge'>" + currentNumberOfQuestion + "/" + numberOfQuestion + "</span>");
}

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


