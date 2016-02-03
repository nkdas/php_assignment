// functions to change the appearance of the input fields according to the validity of their inputs.
function changeAppearanceError(element, message) {
	$(element).parent().removeClass("has-success");
	$(element).next('span').remove();
	$(element).next('label').remove();
	$(element).parent().addClass("has-error has-feedback");
	$(element).after("<span class='glyphicon glyphicon-remove form-control-feedback' aria-hidden='true'></span>");
	$(".has-error .form-control-feedback").css("color", "#f03");
	$(".has-error .form-control").css("border-color", "#f03");
	$(element).next('span').after("<label class='myLabel'>"+message+"</label>");
}

function changeAppearanceCorrect(element) {
	$(element).parent().removeClass("has-error");
	$(element).next('span').remove();
	$(element).next('label').remove();
	$(element).parent().addClass("has-success has-feedback");
	$(element).after("<span class='glyphicon glyphicon-ok form-control-feedback' aria-hidden='true'></span>");
	$(".has-success .form-control-feedback").css("color", "#092");
	$(".has-success .form-control").css("border-color", "#092");
}

function enableButton(button) {
	$(button).removeClass("disabled");
	$(button).prop('disabled', false);
}

function disableButton(button) {
	$(button).addClass("disabled");
	$(button).prop('disabled', true);
}

$(document).ready(function(){
	// validation when the user leaves an input field
  	$(".required").on('blur', function(){
  		var letters = /^[a-zA-Z ]+$/;
		var numbers = /^[0-9]+$/;
		var emailRegex = /^[a-z0-9_-]+@[a-z0-9._-]+\.[a-z]+$/i;
  		var elementId = $(this).attr('id');
		
		if (elementId == 'password') { 
			if ($(this).val().length < 6) {
				changeAppearanceError(this,"Should be of atleast 6 characters");
			}
			else {
				changeAppearanceCorrect(this);
			}
		}

		if (elementId == 'rpassword') {
			if ($(this).val().length < 6) {
				changeAppearanceError(this,"Should be of atleast 6 characters");
			}
			else if ($(this).val() != $('#password').val()) {
				changeAppearanceError(this,"Passwords donot match");
				changeAppearanceError('#password',"Passwords donot match");
			}
			else {
				changeAppearanceCorrect(this);
				changeAppearanceCorrect('#password');
			}
		}

		if ((elementId == 'firstname') || (elementId == 'lastname') || (elementId == 'city') || (elementId == 'state')
			|| (elementId == 'employer')){ 
			if (!$(this).val().match(letters)) {
				changeAppearanceError(this,"Only letters are allowed in this fields");
			}
			else {
				changeAppearanceCorrect(this);
			}
		}
		
		if ((elementId == 'telephone') || (elementId == 'mobile')) { 
			if ((!$(this).val().match(numbers)) || ($(this).val().length != 10)) {
				changeAppearanceError(this,"Mobile number should be of 10 digits and should contain only numbers");
			}
			else {
				changeAppearanceCorrect(this);
			}
		}

		if (elementId == 'zip') { 
			if (!$(this).val().match(numbers)) {
				changeAppearanceError(this,"Zip must contain only numbers");
			}
			else {
				changeAppearanceCorrect(this);
			}
		}

		if ($(this).val() == "") {
			changeAppearanceError(this,"This field cannot be left blank");
		}
		else if((elementId == 'street') || (elementId == 'datePicker')){
				changeAppearanceCorrect(this);
		}
  	});

	$("#form").submit(function(){
		//disableButton('.submit-button');
	});

  	// Add function to the form submission
  	$(".submit-button").on('click', function validate(){ 
  		$("#progress").removeClass("hiddenDiv");
		$("#progress").addClass("visibleDiv");

  		origin = $(this).attr('name');
		var letters = /^[a-zA-Z ]+$/;
		var numbers = /^[0-9]+$/;
		var emailRegex = /^[a-z0-9_-]+@[a-z0-9._-]+\.[a-z]+$/i;
		var errors = "<br><label class='myLabel'>Please Fix the following errors:</label><br>";
		
		var photo = $("#uploadBtn").val();
		var extension = photo.substring(photo.lastIndexOf('.') + 1);
		if( !(extension == "JPEG" || extension == "jpeg" || extension == "jpg" || extension == "JPG" || 
			extension == "png" || extension == "PNG" || extension == "gif" || extension == "GIF") && (photo != "") ) {
			errors += "<label class='myLabel'>Only JPG, PNG and GIF images are allowed as profile photo</label><br>";
		}

		if (origin == "submit") {
			if ($('#username').val() == "") {
				errors += "<label class='myLabel'>Username cannot be blank</label><br>";
				changeAppearanceError('#username',"This field cannot be left blank");
			}
			else if ($('#username').val().length < 6) {
				errors += "<label class='myLabel'>Username should be of atleast 6 characters</label><br>";
				changeAppearanceError('#username',"should be of atleast 6 characters");
			}

			if ($('#password').val() == "") {
				errors += "<label class='myLabel'>Password cannot be blank</label><br>";
				changeAppearanceError('#password',"This field cannot be left blank");
			}
			else if ($('#password').val().length < 6) {
				errors += "<label class='myLabel'>Password should be of atleast 6 characters</label><br>";
				changeAppearanceError('#password',"should be of atleast 6 characters");
			}

			if ($('#rpassword').val() == "") {
				errors += "<label class='myLabel'>Please re-enter your password</label><br>";
				changeAppearanceError('#rpassword',"This field cannot be left blank");
			}
			else if ($('#password').val() != $('#rpassword').val()) {
				errors += "<label class='myLabel'>Passwords entered in the 'Password' and 'Re-enter Password' fields donot match</label><br>";
				changeAppearanceError('#password',"Passwords donot match");
				changeAppearanceError('#rpassword',"Passwords donot match");
			}
		}

		if ($('#firstname').val() == "") {
			errors += "<label class='myLabel'>Firstname cannot be blank</label><br>";
			changeAppearanceError('#firstname',"This field cannot be left blank");
		}
		else if (!$('#firstname').val().match(letters)) {
			errors += "<label class='myLabel'>Firstname should contain only characters</label><br>";
			changeAppearanceError('#firstname',"Only letters are allowed in this field");
		}

		if ($('#lastname').val() == "") {
			errors += "<label class='myLabel'>Lastname cannot be blank</label><br>";
			changeAppearanceError('#lastname',"This field cannot be left blank");
		}
		else if (!$('#lastname').val().match(letters)) {
			errors += "<label class='myLabel'>Lastname should contain only characters</label><br>";
			changeAppearanceError('#lastname',"Only letters are allowed in this field");
		}

		if ($('#datePicker').val() == "") {
			errors += "<label class='myLabel'>Please enter your date of birth</label><br>";
			changeAppearanceError('#datePicker',"This field cannot be left blank");
		}

		if ($('#employer').val() == "") {
			errors += "<label class='myLabel'>Employer cannot be blank</label><br>";
			changeAppearanceError('#employer',"This field cannot be left blank");
		}
		else if (!$('#employer').val().match(letters)) {
			errors += "<label class='myLabel'>Employer should contain only characters</label><br>";
			changeAppearanceError('#employer',"Only letters are allowed in this field");
		}

		if ($('#email').val() == "") {
			errors += "<label class='myLabel'>EMail ID cannot be blank</label><br>";
			changeAppearanceError('#email',"This field cannot be left blank");
		}
		else if (!$('#email').val().match(emailRegex)) {
			errors += "<label class='myLabel'>Please enter a valid email</label><br>";
			changeAppearanceError('#email',"Invalid EMail");
		}
		if(!$('input[name=genderRadio]:checked').val()) {
			errors += "<label class='myLabel'>Please select a gender</label><br>";
		}
		if ($('#street').val() == "") {
			errors += "<label class='myLabel'>Please enter your residential street</label><br>";
			changeAppearanceError('#street',"This field cannot be left blank");
		}
		if ($('#city').val() == "") {
			errors += "<label class='myLabel'>Please enter your residential city</label><br>";
			changeAppearanceError('#city',"This field cannot be left blank");
		}
		else if (!$('#city').val().match(letters)) {
			errors += "<label class='myLabel'>City should contain only characters</label><br>";
			changeAppearanceError('#city',"Only letters are allowed in this field");
		}

		if ($('#state').val() == "") {
			errors += "<label class='myLabel'>Please enter your residential state</label><br>";
			changeAppearanceError('#state',"This field cannot be left blank");
		}
		else if (!$('#state').val().match(letters)) {
			errors += "<label class='myLabel'>State should contain only characters</label><br>";
			changeAppearanceError('#state',"Only letters are allowed in this field");
		}

		if ($('#zip').val() == "") {
			errors += "<label class='myLabel'>Please enter your residential zip code</label><br>";
			changeAppearanceError('#zip',"This field cannot be left blank");
		}
		else if (!$('#zip').val().match(numbers)) {
			errors += "<label class='myLabel'>Zip must contain only numbers</label><br>";
			changeAppearanceError('#zip',"Zip must contain only numbers");
		}

		if ($('#telephone').val() == "") {
			errors += "<label class='myLabel'>Please enter your residential telephone number</label><br>";
			changeAppearanceError('#telephone',"This field cannot be left blank");
		}
		else if (!$('#telephone').val().match(numbers)) {
			errors += "<label class='myLabel'>Telephone number should contain only numbers</label><br>";
			changeAppearanceError('#telephone',"Should contain only numbers");
		}

		if ($('#mobile').val() == "") {
			errors += "<label class='myLabel'>Please enter your residential mobile number</label><br>";
			changeAppearanceError('#mobile',"This field cannot be left blank");
		}
		else if (!$('#mobile').val().match(numbers)) {
			errors += "<label class='myLabel'>Mobile number should contain only numbers</label><br>";
			changeAppearanceError('#mobile',"Should contain only numbers");
		}
		else if ( ($('#mobile').val().length < 10) || ($('#mobile').val().length > 10) ) {
			errors += "<label class='myLabel'>Mobile number should be of 10 digits</label><br>";
			changeAppearanceError('#mobile',"Should be of 10 digits");
		}

		if (errors.length != 71) {
			$('.message').html("<div id='message' class='jumbotron visibleDiv'>" +
				"<label class='myLabel'>" + errors + "</label></div>");
			window.scroll(0,0);
			$("#progress").removeClass("visibleDiv");
			$("#progress").addClass("hiddenDiv");
			enableButton(".submit-button");
			return false;
		}
		else {
			$('.message').html("");
			window.scroll(0,0);
			return true;
		}
  	});

	// function to check uniqueness of username and email id as soon as user leaves the input field
	$(".unique").on('blur', function(){
		if ($(this).attr('id') == "username") {
			$("#usernameProgress").removeClass("hiddenDiv");
			$("#usernameProgress").addClass("visibleDiv");
		}
		else if ($(this).attr('id') == "email") {
			$("#emailProgress").removeClass("hiddenDiv");
			$("#emailProgress").addClass("visibleDiv");
		}
		

		// check for which element the uniqueness is being checked (username or email id)
		if ($(this).attr('id') == 'email') {
			var element = 'email';
		}
		else if ($(this).attr('id') == 'username') {
			var element = 'username';
		}

		// we need to check from where the request is coming from (registration page or edit page)
		if ($(this).attr('class') == 'form-control unique edit') {
			var from = 'edit';
		}
		else {
			var from = 'register';
		}

		$.ajax({
			type: "POST",
			dataType: "json",
			url: "validate.php",
			data: "function=check_uniqueness&element=" + element + "&elementValue=" + $(this).val() + "&from=" + from,

			success: function(data) {
				if (data.status == 1) {
					if (element == 'email') {
						changeAppearanceError('#email', 'This Email ID is already taken');
					}
					else {
						changeAppearanceError('#username', 'This username is already taken');	
					}
				}
				else if (element == 'email') {
					var emailRegex = /^[a-z0-9_-]+@[a-z0-9._-]+\.[a-z]+$/i;
					if (!$('#email').val().match(emailRegex)) {
						changeAppearanceError('#email','Invalid EMail');
					}
					else {
						changeAppearanceCorrect('#email');
					}
				}
				else if (element == 'username') {
					if ($("#username").val().length < 6) {
						changeAppearanceError('#username',"Should be of atleast 6 characters");
					}
					else {
						changeAppearanceCorrect('#username'); 
					}
				} 
			},
			error: function(request, status, error) {
				console.log('error');
			},
		});
		
		if ($(this).attr('id') == "username") {
			$("#usernameProgress").removeClass("visibleDiv");
			$("#usernameProgress").addClass("hiddenDiv");
		}
		else if ($(this).attr('id') == "email") {
			$("#emailProgress").removeClass("visibleDiv");
			$("#emailProgress").addClass("hiddenDiv");
		}
	});
});