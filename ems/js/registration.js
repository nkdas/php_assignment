$(document).ready(function(){
  	// Add scrollspy to <body>
  	$('body').scrollspy({target: ".navbar", offset: 50});   

  	// Add smooth scrolling on all links inside the navbar
  	$("#myNavbar a").on('click', function(event) {

	    // Prevent default anchor click behavior
	    event.preventDefault();

	    // Store hash
	    var hash = this.hash;

	    // Using jQuery's animate() method to add smooth page scroll
	    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
	    $('html, body').animate({
	      	scrollTop: $(hash).offset().top
		}, 800, function(){
		    // Add hash (#) to URL when done scrolling (default click behavior)
		    window.location.hash = hash;
    	});
  	});
});

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#profilePhoto').attr('src', e.target.result)                      
		};
	    reader.readAsDataURL(input.files[0]);
    }
}

function validate(origin) {
	var errors = "";
	var letters = /^[a-zA-Z ]+$/;
	var numbers = /^[0-9]+$/;
	var emailRegex = /^[a-z0-9_-]+@[a-z0-9._-]+\.[a-z]+$/;

	if (origin == "register") {
		if (document.getElementById('username').value == "") {
			errors += "Username cannot be blank\n";
		}
		else if (document.getElementById('username').value.length < 6) {
			errors += "Username should be of atleast 6 characters\n";
		}

		if (document.getElementById('password').value == "") {
			errors += "Password cannot be blank\n";
		}
		else if (document.getElementById('password').value.length < 6) {
			errors += "Password should be of atleast 6 characters\n";
		}

		if (document.getElementById('rpassword').value == "") {
			errors += "Please reenter your password\n";
		}
		else if (document.getElementById('password').value != document.getElementById('rpassword').value) {
			errors += "Passwords entered in the 'Password' and 'Re-enter Password' fields donot match\n";
		}
	}

	if (document.getElementById('firstname').value == "") {
		errors += "Firstname cannot be blank\n";
	}
	else if (!document.getElementById('firstname').value.match(letters)) {
		errors += "Firstname should contain only characters\n";
	}

	if (document.getElementById('lastname').value == "") {
		errors += "Lastname cannot be blank\n";
	}
	else if (!document.getElementById('lastname').value.match(letters)) {
		errors += "Lastname should contain only characters\n";
	}

	if (document.getElementById('suffixSelector').value == "") {
		errors += "Please select a suffix\n";
	}
	if (document.getElementById('datePicker').value == "") {
		errors += "Please enter your date of birth\n";
	}
	if (document.getElementById('employementSelector').value == "") {
		errors += "Please select Employement\n";
	}

	if (document.getElementById('employer').value == "") {
		errors += "Employer cannot be blank\n";
	}
	else if (!document.getElementById('employer').value.match(letters)) {
		errors += "Employer should contain only characters\n";
	}

	if (document.getElementById('email').value == "") {
		errors += "EMail ID cannot be blank\n";
	}
	else if (!document.getElementById('email').value.match(emailRegex)) {
		errors += "Please enter a valid email\n";
	}

	if ( (document.getElementById('male').checked == false) && (document.getElementById('female').checked == false) ) {
		errors += "Please select a gender\n";
	}
	if (document.getElementById('street').value == "") {
		errors += "Please enter your residential street\n";
	}
	if (document.getElementById('city').value == "") {
		errors += "Please enter your residential city\n";
	}
	else if (!document.getElementById('city').value.match(letters)) {
		errors += "City should contain only characters\n";
	}

	if (document.getElementById('state').value == "") {
		errors += "Please enter your residential state\n";
	}
	else if (!document.getElementById('state').value.match(letters)) {
		errors += "State should contain only characters\n";
	}

	if (document.getElementById('zip').value == "") {
		errors += "Please enter your residential zip code\n";
	}

	if (document.getElementById('telephone').value == "") {
		errors += "Please enter your residential telephone number\n";
	}
	else if (!document.getElementById('telephone').value.match(numbers)) {
		errors += "Telephone number should contain only numbers\n";
	}

	if (document.getElementById('mobile').value == "") {
		errors += "Please enter your residential mobile number\n";
	}
	else if (!document.getElementById('mobile').value.match(numbers)) {
		errors += "Mobile number should contain only numbers\n";
	}
	else if ( (document.getElementById('mobile').value.length < 10) || (document.getElementById('mobile').value.length > 10) ) {
		errors += "Mobile number should be of 10 digits\n";
	}

	if (errors.length != 0) {
		alert(errors);
		return false;
	}
}
