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

//function for client side validation
function validate(origin) {
	var errors = "<br><label class='myLabel'>Please Fix the following errors:</label><br>";
	var letters = /^[a-zA-Z ]+$/;
	var numbers = /^[0-9]+$/;
	var emailRegex = /^[a-z0-9_-]+@[a-z0-9._-]+\.[a-z]+$/i;

	var photo = document.getElementById("uploadBtn").value;
	var extension = photo.substring(photo.lastIndexOf('.') + 1);
	if(extension == "JPEG" || extension == "jpeg" || extension == "jpg" || extension == "JPG" || 
		extension == "png" || extension == "PNG" || extension == "gif" || extension == "GIF"){	
	}
	else{
		errors += "<label class='myLabel'>Only JPG, PNG and GIF images are allowed as profile photo</label><br>";
	}

	if (origin == "register") {
		if (document.getElementById('username').value == "") {
			errors += "<label class='myLabel'>Username cannot be blank</label><br>";
		}
		else if (document.getElementById('username').value.length < 6) {
			errors += "<label class='myLabel'>Username should be of atleast 6 characters</label><br>";
		}

		if (document.getElementById('password').value == "") {
			errors += "<label class='myLabel'>Password cannot be blank</label><br>";
		}
		else if (document.getElementById('password').value.length < 6) {
			errors += "<label class='myLabel'>Password should be of atleast 6 characters</label><br>";
		}

		if (document.getElementById('rpassword').value == "") {
			errors += "<label class='myLabel'>Please re-enter your password</label><br>";
		}
		else if (document.getElementById('password').value != document.getElementById('rpassword').value) {
			errors += "<label class='myLabel'>Passwords entered in the 'Password' and 'Re-enter Password' fields donot match</label><br>";
		}
	}

	if (document.getElementById('firstname').value == "") {
		errors += "<label class='myLabel'>Firstname cannot be blank</label><br>";
	}
	else if (!document.getElementById('firstname').value.match(letters)) {
		errors += "<label class='myLabel'>Firstname should contain only characters</label><br>";
	}

	if (document.getElementById('lastname').value == "") {
		errors += "<label class='myLabel'>Lastname cannot be blank</label><br>";
	}
	else if (!document.getElementById('lastname').value.match(letters)) {
		errors += "<label class='myLabel'>Lastname should contain only characters</label><br>";
	}

	if (document.getElementById('suffixSelector').value == "") {
		errors += "<label class='myLabel'>Please select a suffix</label><br>";
	}
	if (document.getElementById('datePicker').value == "") {
		errors += "<label class='myLabel'>Please enter your date of birth</label><br>";
	}
	if (document.getElementById('employementSelector').value == "") {
		errors += "<label class='myLabel'>Please select Employement</label><br>";
	}

	if (document.getElementById('employer').value == "") {
		errors += "<label class='myLabel'>Employer cannot be blank</label><br>";
	}
	else if (!document.getElementById('employer').value.match(letters)) {
		errors += "<label class='myLabel'>Employer should contain only characters</label><br>";
	}

	if (document.getElementById('email').value == "") {
		errors += "<label class='myLabel'>EMail ID cannot be blank</label><br>";
	}
	else if (!document.getElementById('email').value.match(emailRegex)) {
		errors += "<label class='myLabel'>Please enter a valid email</label><br>";
	}

	if ( (document.getElementById('male').checked == false) && (document.getElementById('female').checked == false) ) {
		errors += "<label class='myLabel'>Please select a gender</label><br>";
	}
	if (document.getElementById('street').value == "") {
		errors += "<label class='myLabel'>Please enter your residential street</label><br>";
	}
	if (document.getElementById('city').value == "") {
		errors += "<label class='myLabel'>Please enter your residential city</label><br>";
	}
	else if (!document.getElementById('city').value.match(letters)) {
		errors += "<label class='myLabel'>City should contain only characters</label><br>";
	}

	if (document.getElementById('state').value == "") {
		errors += "<label class='myLabel'>Please enter your residential state</label><br>";
	}
	else if (!document.getElementById('state').value.match(letters)) {
		errors += "<label class='myLabel'>State should contain only characters</label><br>";
	}

	if (document.getElementById('zip').value == "") {
		errors += "<label class='myLabel'>Please enter your residential zip code</label><br>";
	}

	if (document.getElementById('telephone').value == "") {
		errors += "<label class='myLabel'>Please enter your residential telephone number</label><br>";
	}
	else if (!document.getElementById('telephone').value.match(numbers)) {
		errors += "<label class='myLabel'>Telephone number should contain only numbers</label><br>";
	}

	if (document.getElementById('mobile').value == "") {
		errors += "<label class='myLabel'>Please enter your residential mobile number</label><br>";
	}
	else if (!document.getElementById('mobile').value.match(numbers)) {
		errors += "<label class='myLabel'>Mobile number should contain only numbers</label><br>";
	}
	else if ( (document.getElementById('mobile').value.length < 10) || (document.getElementById('mobile').value.length > 10) ) {
		errors += "<label class='myLabel'>Mobile number should be of 10 digits</label><br>";
	}

	if (errors.length != 0) {
		document.getElementById('message').style.display = "block";
		document.getElementById('message').innerHTML = errors;
		window.scroll(0,0);
		return false;
	}
}
