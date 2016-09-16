var isFinish = [];

$(document).ready(function () {
    showQuestion(0);
    $('input[type=radio][name=answer]').click(function () {
        $('.answer').find('span').remove()
    });
});

function showResult(id) {
    $('.answer').find('span').remove();
    $('#' + id).append("   <span class='glyphicon glyphicon-ok correct'></span>");
}

function showQuestion(number) {
    console.log(number);
    /* init variable */
    var words = $('input[name=words]').val();
    var wordAnswers = $('input[name=wordAnswers]').val();
    var numberOfQuestion = $('input[name=numberOfQuestion]').val();
    var wordsJson = JSON.parse(words);
    var wordAnswersJson = JSON.parse(wordAnswers);
    var $wordIds = [];
    var $wordNames = [];

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

    /* Select answer */
    for(var i = 0; i < wordAnswersJson.length; i++) {
        if (wordAnswersJson[i].word_id == $wordId) {
            html += "<label class='answer' id='" + wordAnswersJson[i].id + "'>";
            html += "<input type='radio' name='answer' value='" + wordAnswersJson[i].id + "'>  " + wordAnswersJson[i].content + "</label><br>"
        }
    }

    html += "</div>";
    html += "<hr>";
    html += "<button class = 'btn btn-success submit' onclick = 'check(" + number +")'>Submit</button>";

    /* Button next */
    if(number < numberOfQuestion && isFinish.indexOf(number + 1) == -1) {
        html += "<button class = 'btn btn-primary' onclick='showQuestion(" + (number + 1) + ")'>Next</button>";
    } else {
        for (i = 0; i < number; i++) {
            if(isFinish.indexOf(i) == -1) {
                var tmp = number;
                number = i;
                i = tmp;
            }
        }

        if(number < numberOfQuestion) {
            html += "<button class = 'btn btn-primary' onclick='showQuestion(" + number + ")'>Next</button>";
        }
    }

    html += "<input type='hidden' name='word' value='" + $wordId +"'>";
    $('#question').html(html);
}

function check(number) {

    $('.answer').find('span').remove();
    $('.submit').attr("disabled", true);
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
                $('.submit').attr("disabled", false);
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

