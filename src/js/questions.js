function questions(questions) {
    var data = $("#data");

    var ag = questions[0]['questionqroup'];

    var displayquestions = $("<form id='" + ag + "' />");
    $.each(questions, function (key, question) {
        var qt = question['questiontext'];
        var questionid = question['questionid'];
        var displayanswers = $("<div class='answers'/>");
        var displayquestion = $("<div id='" + questionid + "' class='question'>" + qt + "</div>")
        $.each(question['answers'], function (kay, answer) {
            var at = answer['answertext'];
            var aid = answer['answerid'];

            displayanswers.append(
                $("<input type='radio' value='" + aid + "' name='" + questionid + "'/><label>" + at + "</label>")
            );
        });
        displayquestions.append(displayquestion);
        displayquestions.append(displayanswers);
    });
    var button = $("<button>Get Report</button>");
    button.click(sendanswers);
    data.append(displayquestions);
    data.append(button);
}

function sendanswers() {
    var answers = "";
    $.ajax({
        type:"POST",
        url:"../getanswers.json.php",
        data:{ "json":JSON.stringify(answers)},
        dataType:"json"
    }).always(function (data) {
            console.log("sent")
    });
}
