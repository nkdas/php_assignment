// function to send credentials to the server and authenticate user
$("document").ready(function(){
	$("#signin").click(function(){
		$("#progress").removeClass("hiddenDiv");
		$("#progress").addClass("visibleDiv");
		var errors = "";
		if ($('#username').val() == "") {
			errors += "<label class='myLabel'>Username cannot be blank</label><br>";
		}
		if ($('#password').val() == "") {
			errors += "<label class='myLabel'>Password cannot be blank</label><br>";
		}
		if (!(errors.length != 0)) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "authenticate.php",
				data: "username=" + $('#username').val() + "&password=" + $('#password').val(),
				success: function(data) {
					if (data.status == '1') {
						window.location.replace("home.php");
					}
					else if (data.status == '2') {
						errors += "<label class='myLabel'>Please activate your account before signing in</label><br>";
						showErrors(errors);
					}
					else {
						errors += "<label class='myLabel'>Either username or password is invalid</label><br>";
						showErrors(errors);
					}
				},
				error: function() {
					errors += "Sorry, there was a problem!";
					showErrors(errors);
				},
			});
		}
		if (errors.length != 0) { 
			showErrors(errors);
		}
		$(".progress").removeClass("visibleDiv");
		$(".progress").addClass("hiddenDiv");
	});

	function showErrors(errors) {
		$('.message').html("<div id='message' class='jumbotron visibleDiv'>" +
				"<label class='myLabel'>" + errors + "</label></div>");
			window.scroll(0,0);
	}
});