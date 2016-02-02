<?php
/**
* This page fetches data from the $_POST and sets them to their respective variables
*/

/**
* $post will contain an array of data submitted by the user that are present in $_POST
* $files will contain an array of data submitted by the user that are present in $_FILES
* $connectio will store the database connection
*/

function set_data($post, $files, $connection) {
	// set data for $photo
	try
	{
		$path = getcwd();
		// check if the uploaded image is present in $_FILES
	    if ($_FILES['photo']['name']) {
	        $photo = basename($_FILES['photo']['name']);
	        $imageFileType = pathinfo($path . '/images/'. $photo,PATHINFO_EXTENSION);
	        // move the image to the server only if it is a .jpg, .png, .jprg or .gif
	        if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) {
	        	move_uploaded_file($_FILES['photo']['tmp_name'], $path . "/images/" . $photo);
	        }
	        else {
	        	$photo = 'unknown extension';
	        }
	    }

	    // check if the image was already in the $_SESSION
	    else if ($_SESSION['photo']) {
	        $photo = $_SESSION['photo'];
	    }

	    // if the image is neither in the $_FILES nor $_SESSION then set the default image for the user
	    else {
	        $photo = "userTile.png";
	    }
	}
	catch (Exception $ex) {}

    // fetch user details from $post
    try
 	{
		$record['username'] = mysqli_real_escape_string($connection, trim($post['username']));
	}
	catch (Exception $ex) {}

	try
	{
		$record['password'] = mysqli_real_escape_string($connection, trim($post['password']));
	}
	catch (Exception $ex) {}

	try
	{
		$record['rpassword'] = mysqli_real_escape_string($connection, trim($post['rpassword']));
	}
	catch (Exception $ex) {}

	$record['firstname'] = mysqli_real_escape_string($connection, trim($post['firstname']));
	$record['middlename'] = mysqli_real_escape_string($connection, trim($post['middlename']));
	$record['lastname'] = mysqli_real_escape_string($connection, trim($post['lastname']));
	$record['suffix'] = mysqli_real_escape_string($connection, trim($post['suffixSelector']));
	$record['gender'] = mysqli_real_escape_string($connection, trim($post['genderRadio']));
	$record['dob'] = mysqli_real_escape_string($connection, trim($post['datePicker']));
	$record['marital'] = mysqli_real_escape_string($connection, trim($post['maritalSelector']));
	$record['employement'] = mysqli_real_escape_string($connection, trim($post['employementSelector']));
	$record['employer'] = mysqli_real_escape_string($connection, trim($post['employer']));
	$record['email'] = mysqli_real_escape_string($connection, trim($post['email']));
	
	$record['street'] = mysqli_real_escape_string($connection, trim($post['street']));
	$record['city'] = mysqli_real_escape_string($connection, trim($post['city']));
	$record['state'] = mysqli_real_escape_string($connection, trim($post['state']));
	$record['zip'] = mysqli_real_escape_string($connection, trim($post['zip']));
	$record['telephone'] = mysqli_real_escape_string($connection, trim($post['telephone']));
	$record['mobile'] = mysqli_real_escape_string($connection, trim($post['mobile']));
	$record['fax'] = mysqli_real_escape_string($connection, trim($post['fax']));

	$record['ostreet'] = mysqli_real_escape_string($connection, trim($post['ostreet']));
	$record['ocity'] = mysqli_real_escape_string($connection, trim($post['ocity']));
	$record['ostate'] = mysqli_real_escape_string($connection, trim($post['ostate']));
	$record['ozip'] = mysqli_real_escape_string($connection, trim($post['ozip']));
	$record['otelephone'] = mysqli_real_escape_string($connection, trim($post['otelephone']));
	$record['omobile'] = mysqli_real_escape_string($connection, trim($post['omobile']));
	$record['ofax'] = mysqli_real_escape_string($connection, trim($post['ofax']));

	try {
		$record['emailcheck'] = mysqli_real_escape_string($connection, trim($post['emailCheck']));
	}
	catch (Exception $e) {
		$record['emailcheck'] = 0;
	}

	try {
		$record['messagecheck'] = mysqli_real_escape_string($connection, trim($post['messageCheck']));
	}
	catch (Exception $e) {
		$record['messagecheck'] = 0;
	}

	try {
		$record['phonecheck'] = mysqli_real_escape_string($connection, trim($post['phoneCheck']));
	}
	catch (Exception $e) {
		$record['phonecheck'] = 0;
	}

	try {
		$record['anycheck'] = mysqli_real_escape_string($connection, trim($post['anyCheck']));
	}
	catch (Exception $e) {
		$record['anycheck'] = 0;
	}

	$record['more'] = addslashes(mysqli_real_escape_string($connection, trim($post['more'])));

	try
	{
		$record['photo'] = $photo;
	}
	catch (Exception $ex){}
	return $record;
}
?>