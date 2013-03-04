function questions(questions) {
    var data = $("#data");

    var ag = questions[0]['questiongroup'];

    var displayquestions = $("<form id='" + ag + "' />");
    $.each(questions, function (key, question) {
        var qt = question['questiontext'];
        var questionid = question['questionid'];
        var displayanswers = $("<div class='answers'/>");
        var displayquestion = $("<br /><br /><div id='" + questionid + "' class='question'>" + qt + "<br /></div><br />")
        $.each(question['answers'], function (kay, answer) {
            var at = answer['answertext'];
            var aid = answer['answerid'];

            displayanswers.append(
                $("<input type='radio' value='" + aid + "' name='" + questionid + "'/><label><em>" + at + "</em></label></br /><br />")
            );
        });
        displayquestions.append(displayquestion);
        displayquestions.append(displayanswers);
    });
    var button = $("<button>Get Report</button>");
    button.click(sendanswers);
    data.append(displayquestions);
    addadditionalquestions(displayquestions);
    data.append(button);
}


var answers = {};
function sendanswers() {
		$("form input").each( function( key, obj) {
				if(obj.checked == false && obj.type == 'radio') return;
				console.log(obj.name +"-"+ obj.value);
				answers[obj.name] = obj.value;
		});

		console.dir(answers);
    $.ajax({
        type:"POST",
        url:"/getanswers.json.php",
        data: { json: JSON.stringify(answers)},
        dataType:"json",
				mimeType:"application/json"
    }).always(function (data) {
				console.log("sent")
				console.log(answers);
    });
}

var additionalquestions = [
{	 name: "pname",	label: "Title: Give your assignment a name", position: "top"},
{	 name: "branch", 	label: "Branch: The client or problem owner of this assignment works in...", position: "top"},
{	 name: "performer", 	label: "Expertise: The expertise of the company or person who performs this assignment is to", position: "bottom"},
{	 name: "mail", 	label: "Email", position: "bottom"},
{	 name: "price",	label: "Name your own price - <em>Your paypal will be changed for this amount</em>", position: "bottom"}
	];

function addadditionalquestions(obj) {
	var container = $("<div id='container' />");
	$.each(additionalquestions, function( i, elem) {
		var q = $("<p><label>" + elem.label + " </label><br /><input type='text' value='' name='" + elem.name + "'/></p>");
		container.append(q);
	});
	obj.prepend(container);
}

function answersieve(as) {
	var data = $("#data");
	$.each( as, function( key, val) {
			data.append($("<div style='border: 1px green dotted;'>"+ val +"</div>"));
	});
}
