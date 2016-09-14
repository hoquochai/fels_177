$(document).ready(function () {
    $('.submit').click(function () {
        $('.answer').find('span').remove();
        $(this).attr("disabled", true);
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
    });

    $('input[type=radio][name=answer]').click(function () {
        $('.answer').find('span').remove()
    });
});

function showResult(id) {
    $('.answer').find('span').remove();
    $('#' + id).append("   <span class='glyphicon glyphicon-ok correct'></span>");
}
