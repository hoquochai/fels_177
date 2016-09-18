function showLesson() {
    var id = $('.view-lesson').attr('id');
    var tokenLesson = $('input[name=_token]').val();
    var route = $('input[name=route]').val();
    var routeResult = $('input[name=routeResult]').val();
    var messageLesson = $('input[name=messageLesson]').val();
    $.ajax({
        url: route,
        type: 'post',
        data: {
            '_token': tokenLesson,
            'id': id
        },
        success: function (data) {
            var messageRtn = JSON.parse(messageLesson);
            var html = "<div class='panel-heading'> <h1>" + messageRtn.word_result + "</h1> </div>";
            if (data.result == false) {
                html += "<div class='alert alert-danger'>" + messageRtn.error_display_word + "</div>";
            } else {
                var lessonWords = data.lessonWords;
                var userWords = data.userWords;
                var lessonWordsParse = JSON.parse(lessonWords);
                var userWordsParse = JSON.parse(userWords);
                html += "<div class='panel-body'> " +
                    "<table class='table table-hover'> " +
                    "<thead> " +
                    "<tr> " +
                    "<th>" + messageRtn.result_head_name + "</th> " +
                    "<th>" + messageRtn.word_head_name + "</th>" +
                    "<th>" + messageRtn.word_answer_head_name + "</th> " +
                    "</tr> " +
                    "</thead> " +
                    "<tbody>";
                for (var index = 0; index < lessonWordsParse.length; index++) {
                    var iscorrect = false;
                    html += "<tr>";
                    for (var i = 0; i < userWordsParse.length; i++) {
                        if (userWordsParse[i].word_id == lessonWordsParse[index].word_id) {
                            html += "<td>" + messageRtn.sign_correct + "</td>";
                            iscorrect = true;
                            i = userWordsParse.length;
                        }
                    }

                    if (!iscorrect) {
                        html += "<td>" + messageRtn.sign_incorrect + "</td>";
                    }

                    html += "<td>" + lessonWordsParse[index].word.content + "</td>";
                    if (typeof lessonWordsParse[index].word.word_answers === 'undefined' || !lessonWordsParse[index].word.word_answers.length) {
                        html += "<td> No answer </td>";
                    } else {
                        var wordAnswersParse = lessonWordsParse[index].word.word_answers;
                        for (var i = 0; i < wordAnswersParse.length; i++) {
                            if (wordAnswersParse[i].correct == messageRtn.is_correct) {
                                html += "<td>" + wordAnswersParse[i].content + "</td>";
                            }
                        }
                    }

                    html += "</tr>";
                }

                html += "</tbody> </table> " +
                    "<a href='" + routeResult + "'><button class='btn btn-primary'>" + messageRtn.btn_back + "</button></a></div>";
            }


            $('#result').html(html);
        }
    });
}
