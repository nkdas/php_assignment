<?php
/**
* This page provides database functions
*/

// function to insert a record while registration
function insert_record($record, $connection) {
	// prepare statement
	$statement = $connection->prepare(
		"INSERT INTO details (username, password, firstname, middlename, lastname, suffix, gender, dob, marital, employement, 
			employer, email, street, city, state, zip, telephone, mobile, fax, ostreet, ocity, ostate, ozip, otelephone, 
			omobile, ofax, emailcheck, messagecheck, phonecheck, anycheck, more, photo)
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
	);

	if($statement) {
		// bind parameters
		$statement->bind_param("ssssssisssssssssssssssssssiiiiss", 
			$record['username'], $record['password'], $record['firstname'], $record['middlename'], $record['lastname'], $record['suffix'], 
			$record['gender'], $record['dob'], $record['marital'], $record['employement'], $record['employer'], $record['email'], 
			$record['street'], $record['city'], $record['state'], $record['zip'], $record['telephone'], $record['mobile'], $record['fax'], 
			$record['ostreet'], $record['ocity'], $record['ostate'], $record['ozip'], $record['otelephone'], $record['omobile'], 
			$record['ofax'], $record['emailcheck'], $record['messagecheck'], $record['phonecheck'], $record['anycheck'], $record['more'], 
			$record['photo']);

		 // execute query to insert data into the database
		if($statement->execute()) {
			$username = $record['username'];
			$query= mysqli_query($connection, "SELECT id 
				FROM details 
				WHERE username = '$username'");
			if ($query and $row = mysqli_fetch_assoc($query)) {

				$key = md5($row['id']);
                //if insertion to the database completed successfully
				$query2 = mysqli_query($connection, "UPDATE details SET activation_key = '$key' WHERE username = '$username' "); 

                // create session to carry the data required to send email and redirect the page to mail.php
				$_SESSION['id'] = $row['id'];
				$_SESSION['mail_to'] = $record['email'];
				$_SESSION['subject'] = "Account activation";
				$_SESSION['message'] = "Registration successful!<br>Please check your email to activate your account.";
				$_SESSION['mail_body'] = "Hi " . $record['firstname'] . "!<br>Thank you for registering to EMS<br>
				Please follow the link below to activate your account:<br>
				<a href='http://localhost/ems/activation.php?id=" . $row['id'] . "&key=" . $key . "'>Activate my account</a>";
				return 1;
			}
			else {
				return $connection->error;
			}		
		}
		else {
			return $connection->error;
		}
	}
	else {
		return $connection->error;
	}
}

// function to authenticate a user while signing in
function check_login_details($username, $password, $connection) {	
	$query = "SELECT id, activation
                FROM details 
                WHERE username = '$username' AND password = '$password'";
	$sql = mysqli_query($connection, $query);

    // if the query executes successfully then the user is registered and the credentials are valid
    if ($sql and $row = mysqli_fetch_assoc($sql)) {
	    // check if the account of the registered user is activated
	    if($row['activation'] == 1) {
	    	// if the account of the user is activated, then create sessions for the user and
	        $_SESSION['id'] = $row['id'];
	        return 1;
	    }
	    else {
	        return 2;
	    }
	}
	else {
		return 3;
	}
}

// function to update the record of a user
function update_record($userId, $connection, $record) {	
	$query = "UPDATE details 
	SET firstname = '" . $record['firstname'] . "', middlename = '" . $record['middlename'] . "', lastname = '" . $record['lastname'] . 
	"', suffix = '" . $record['suffix'] . "', gender = '" . $record['gender'] . "', dob = '" . $record['dob'] . 
	"', marital = '" . $record['marital'] . "', employement = '" . $record['employement'] . "',employer = '" . $record['employer'] . 
	"', email = '" . $record['email'] . "', street = '" . $record['street'] . "', city = '" . $record['city'] . "', state = '" . $record['state'] . 
	"', zip = '" . $record['zip'] . "', telephone = '" . $record['telephone'] . "', mobile = '" . $record['mobile'] . "', fax = '" . $record['fax'] . 
	"', ostreet = '" . $record['ostreet'] . "', ocity = '" . $record['ocity'] . "',ostate = '" . $record['ostate'] . "', ozip = '" . $record['ozip'] . 
	"', otelephone = '" . $record['otelephone'] . "', omobile = '" . $record['omobile'] . "', ofax = '" . $record['ofax'] . 
	"',emailcheck = '" . $record['emailcheck'] . "', messagecheck = '" . $record['messagecheck'] . "', phonecheck = '" . $record['phonecheck'] . 
	"',anycheck = '" . $record['anycheck'] . "', more = '" . $record['more'] . "', photo = '" . $record['photo'] . 
	"' WHERE id = $userId";
	$sql = mysqli_query($connection, $query);

    if($query) {
        return 1;
    }
    else {
        return 2;
    }
}

// function to retrieve record from the database and send to editing form
function get_record_for_updation($userId, $connection) {	
	$query = mysqli_query($connection, "SELECT username, password, firstname, middlename, lastname, suffix, gender, dob, marital, employement, employer, email, 
                street, city, state, zip, telephone, mobile, fax, ostreet, ocity, ostate, ozip, otelephone, omobile, ofax,
                emailcheck, messagecheck, phonecheck, anycheck, more, photo
                FROM details
                WHERE id = $userId");
    if ($query and $row = mysqli_fetch_assoc($query)) { 
        $_SESSION['photo'] = $row['photo'];
    }
    return $row;
}
?>