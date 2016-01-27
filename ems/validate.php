<?php
// $record will contain an array of data submitted by the user
// $connection will store the database connection
// $from will indicate which page is requesting a validation (registration page or the edit page)
function validate($record, $connection, $from) {

	//array to store the errors.
	$errors = array();
    //i serves as the key or index to the array $errors.
	$i = 1; 

	// validate photo
	if ($record['photo'] == 'unknown extension') {
		$errors[$i] = "Only JPG, JPEG, PNG & GIF files are allowed as profile photo.";
		$i++;
	}
	else {
		$_SESSION['photo'] = $record['photo'];
	}

	// only the registeration page requires validations for username and password
	if($from == "register") {

		if (empty($record['username'])) {
			$errors[$i] = "You must enter a username";
			$i++;
		}
		// check the length of the username entered
		else if (strlen($record['username']) < 6) {
			$errors[$i] = "Username must be of atleast 6 characters";
			$i++;
		}

		// check if the username is already being used by someone
		$username = $record['username'];
	    $query = mysqli_query($connection, "SELECT id FROM details WHERE username = '$username'");
		if ($query and $row = mysqli_fetch_assoc($query)) {
			$errors[$i] = "This username is already taken, Please use another";
			$i++;
		}

		if (empty($record['password'])) {
			$errors[$i] = "You must enter your password";
			$i++;
		} 
		// check the length of the password
		else if (strlen($record['password']) < 6) {
			$errors[$i] = "Passwords must be of at least 6 characters";
			$i++;
		} 
		// check if both the passwords entered by the user match
		if($record['password'] != $record['rpassword']) {
			$errors[$i] = "Passwords entered in the 'Password' and 'Re-enter Password' fields donot match";
			$i++;
		}
	}

	// check for firstname
	if (empty($record['firstname'])) {
		$errors[$i] = "You must enter your First name";
		$i++;
	}
	else if (ctype_alpha($record['firstname']) === false) {
		$errors[$i] = "A name must contain only characters";
		$i++;
	}

	// check for lastname
	if (empty($record['lastname'])) {
		$errors[$i] = "You must enter your Last name";
		$i++;
	}
	else if (ctype_alpha($record['lastname']) === false) {
		$errors[$i] = "A name must contain only characters";
		$i++;
	}

	// chec for date of birth
	if (empty($record['dob'])) {
		$errors[$i] = "You must enter your date of birth";
		$i++;
	}

	// check for employer
	if (empty($record['employer'])) {
		$errors[$i] = "You must enter your Employer";
		$i++;
	}

	// validate email
	if (!preg_match('/^[a-z0-9_-]+@[a-z0-9._-]+\.[a-z]+$/i', $record['email'])) {
		$errors[$i] = "Please enter a valid email";
	} 

    // check if the email is already being used by someone
	$email = $record['email']; 
    if($from == "update") {
    	$userId = $_SESSION['id'];
		$query = mysqli_query($connection, "SELECT id 
			FROM details
			WHERE email = '$email' AND  id != $userId ");
		if ($query and $row = mysqli_fetch_assoc($query)) {
			$errors[$i] = "This email id is already taken, Please use another";
			$i++;
		}       
	}
	else
	{
		$query = mysqli_query($connection, "SELECT id 
				FROM details
				WHERE email = '$email'");
			if ($query and $row = mysqli_fetch_assoc($query)) {
				$errors[$i] = "This email id is already taken, Please use another";
				$i++;
			}       
	}

	if (empty($record['gender'])) {
		$errors[$i] = "You must select your Gender";
		$i++;
	}

	if (empty($record['street'])) {
		$errors[$i] = "You must enter your Residential Street";
		$i++;
	}

	if (empty($record['city'])) {
		$errors[$i] = "You must enter your Residential City";
		$i++;
	}
	else if (ctype_alpha($record['city']) === false) {
		$errors[$i] = "A city name must contain only characters";
		$i++;
	}

	if (empty($record['state'])) {
		$errors[$i] = "You must enter your Residential State";
		$i++;
	}
	else if (ctype_alpha($record['state']) === false) {
		$errors[$i] = "A state name must contain only characters";
		$i++;
	}

	if (empty($record['zip'])) {
		$errors[$i] = "You must enter your Residential Zip";
		$i++;
	}
	else if (ctype_digit($record['zip']) === false) {
		$errors[$i] = "A zip must contain only digits";
		$i++;
	}

	if (empty($record['telephone'])) {
		$errors[$i] = "You must enter your Residential Telephone number. 
		If you donot have one, then enter your mobile number in both the fields";
		$i++;
	}
	else if (ctype_digit($record['telephone']) === false) {
		$errors[$i] = "A telephone number must contain only digits";
		$i++;
	}
	else if ( !(strlen($record['telephone']) == 10)) {
		$errors[$i] = "A telephone number must be of 10 digits";
		$i++;
	}

	if (empty($record['mobile'])) {
		$errors[$i] = "You must enter your Residential Mobile number. 
		If you donot have one, then enter your telephone number in both the fields";
		$i++;
	}
	else if (ctype_digit($record['mobile']) === false) {
		$errors[$i] = "A mobile number must contain only digits";
		$i++;
	}
	else if ( !(strlen($record['mobile']) == 10)) {
		$errors[$i] = "A mobile number must be of 10 digits";
		$i++;
	}

	return $errors;
}
?>