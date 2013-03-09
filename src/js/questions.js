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
				//console.log(obj.name +"-"+ obj.value);
				answers[obj.name] = obj.value;
		});

		//console.dir(answers);
    $.ajax({
        type:"POST",
        url:"/getanswers.json.php",
        data: { json: JSON.stringify(answers)},
        dataType:"json",
				mimeType:"application/json"
    }).complete(function(data) {
				$("#thanks").append( "<br /><br /><small><em>"+ data.responseText +"</em></small>");
				$("#thanks").show();
		}).always(function (data) {
				//console.log("sent")
				//console.log(answers);
				$("#thanks").show();
    });
}

var additionalquestions = [
{	 name: "branch", 	label: "Branch: The client or problem owner of this assignment works in...", position: "top", type: "select"},
{	 name: "pname",	label: "Title: Give your assignment a name", position: "top", type: "text"},
{	 name: "performer", 	label: "Expertise: The expertise of the company or person who performs this assignment is to", position: "bottom", type: "select", type: "select"},
{	 name: "mail", 	label: "Email", position: "bottom", type: "text"},
{	 name: "price",	label: "Name your own price - <em>Your paypal will be changed for this amount</em>", position: "bottom", type: "text"}
	];

function addadditionalquestions(obj) {
	var container = $("<div id='container' />");
	$.each(additionalquestions, function( i, elem) {
			var q;
			if(elem.type == "select") {
				q = $("<p><label>" + elem.label + " </label><br /><select id='"+ elem.name +"' name='" + elem.name + "'/></p>");
				$.getJSON('/js/'+ elem.name +'.json', function(list) {
					//console.log("X");
					var selector = [];
					$.each(list, function(key, val) {
						selector.push('<option value='+ val +'>'+ val +"</option>");
					});
					$("#"+ elem.name).append(selector.join());
				});
			} else
				q = $("<p><label>" + elem.label + " </label><br /><input type='text' value='' name='" + elem.name + "'/></p>");

			if(elem.position == 'top')
				container.prepend(q);
			else // FIXME: Dirty hack
				$("#assignmentoracle").append(q);
	});
	obj.prepend(container);
}

function answersieve(as) {
	var data = $("#data");
	var lookup = [];
	$.getJSON('/questions.json.php?id=assignmentoracle', function(list) {
			$.each(list, function( key, val) {
				var qid = this.questionid;
				lookup[qid] = [];
				$.each(this.answers, function( keya, vala) {
					lookup[qid][vala.answerid] = vala.answertext;
				});
			},{ async: false });
			$.each( as, function( key, val) {
					if(val != null) {
						data.append($("<br/><br/><br/><br/><br/><br/><h3>You said...</h3>"));
						data.append($("<div>"+ lookup[key +'A'][answers[key +'A']] +"</div>"));
						// FIXME: Dirty hack
						if( key != "have") {
							data.append($("<div style='text-align: center;'>AND</div><div>"+ lookup[key +'B'][answers[key +'B']] +"</div>"));
						}
						data.append($("<br/><h3>The Last Consultant responds...</h3>"));
						data.append($("<div>"+ val +"</div>"));
					}
			});
			//console.log(lookup);
	data.append($("#outro"));
	});
}
