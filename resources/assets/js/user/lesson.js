var isFinish = [];
var isChoose = [];
var routeResult = $('.hide').data("routeResult");
var lessonId = $('.hide').data("lessonId");
var wordQuestions = [];
var wordName = "";

$(document).ready(function () {
    showQuestion(0);
});

/**
 * show question of number
 * @param number
 */
function showQuestion(number) {
    var dataQuestions = $('.hide').data("questions");
    var htmlMiss = "";
    for (var index = 0; index < dataQuestions.length; index++) {
        var arrayQuestionNotAnswer = [];
        if (dataQuestions[index].question_number == number) {
            wordName = dataQuestions[index].word_name;
            $("#question").html(dataQuestions[index].html);

            /* Button previous */
            for (i = 0; i < isChoose.length; i++) {
                $('#' + isChoose[i]).attr('checked', true);
            }

            /* Button miss */
            for (var i = 0; i < number; i++) {
                if (isFinish.indexOf(i) == -1 && arrayQuestionNotAnswer.indexOf(i) == -1) {
                    arrayQuestionNotAnswer.push(i);
                }
            }

            if (arrayQuestionNotAnswer.length > 0) {
                for (var i = 0; i < arrayQuestionNotAnswer.length; i++) {
                    htmlMiss += "<button class = 'btn btn-primary btn-xs btn-miss' id='"+ arrayQuestionNotAnswer[i]
                        +"' onclick='showQuestion(" + (arrayQuestionNotAnswer[i]) + ")'>" +
                        "<span class='badge'>" + (arrayQuestionNotAnswer[i] + 1) + "</span></button>";
                }
            }

            $('#question-miss').html(htmlMiss);
        }
    }
}

/**
 * save answer which user choose
 * @param number
 * @param wordId
 */
function saveAnswer(number, wordId) {
    number = parseInt(number);
    if (isFinish.indexOf(number) == -1) {
        isFinish.push(number);
    }

    if (wordQuestions.indexOf(wordId) == -1) {
        wordQuestions.push(wordId);
    }

    id = $('input[type=radio][name=answer]:checked').attr('id');
    id = parseInt(id);
    if (isChoose.indexOf(id) == -1) {
        isChoose.push(id);
    }


}

/**
 * finish lesson
 */
function submitLesson() {
    $('.btn-previous').attr("disabled", true);
    $('.btn-next').attr("disabled", true);
    $('.btn-miss').attr("disabled", true);
    $.ajax({
        url: $('.hide').data("route"),
        type: 'post',
        data: {
            'questions': wordQuestions,
            '_token': $('.hide').data("token"),
            'answers': isChoose,
            'lessonId' : lessonId
        },
        success: function (data) {
            if (data.success) {
                window.location.href = routeResult;
            }
        }
    });
}

function speak() {
    responsiveVoice.speak(wordName);
}


