$("document").ready(function(){
	$("#signin").click(function(){
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
				},
				error: function() {
					errors += "Sorry, there was a problem!";
				},
			});
		}
		else {
			$('.message').html("<div id='message' class='jumbotron visibleDiv'>" +
				"<label class='myLabel'>" + errors + "</label></div>");
			window.scroll(0,0);
			return false;
		}
	});
});