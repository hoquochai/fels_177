$(document).ready(function () {
    $('#btn-filter').click(function () {
        $('#resultPfd').html("");
        $.ajax({
            url: $('.hide-word-list').data("routeFilter"),
            type: 'post',
            data: {
                'category': $('select[name=category]').val(),
                'type': $('input[name=type]:checked').val(),
                '_token': $('.hide-word-list').data("token")
            },
            success: function (data) {
                var html = "";
                var messageRtn = $('.hide-word-list').data("messageFilter");
                if (data.success == false) {
                    html = "<div class='alert alert-danger'>" + messageRtn.not_choose_filter + "</div>";
                } else {
                    var dataRtn = data.data;
                    var wordFilter = "";
                    if (dataRtn.length > 0) {
                        for(var index = 0; index < dataRtn.length; index ++) {
                            html += "<div class='col-lg-6'>";
                            html += dataRtn[index].content;
                            html += "</div>";
                            wordFilter += dataRtn[index].content + ",";
                        }
                        html += "<input type='hidden' name='wordFilter' value='"
                            + wordFilter.substring(0, wordFilter.length - 1) + "'>"
                    } else {
                        html = "<div class='alert alert-info'>" + messageRtn.words_not_found + "</div>";
                    }
                }

                $('.filter-result').html(html);
            }
        });
    });
});
