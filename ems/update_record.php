<?php
require_once('db_connection.php');

$username = mysqli_real_escape_string($connection, trim($_POST['username']));
$record['firstname'] = mysqli_real_escape_string($connection, trim($_POST['firstname']));
$record['middlename'] = mysqli_real_escape_string($connection, trim($_POST['middlename']));
$record['lastname'] = mysqli_real_escape_string($connection, trim($_POST['lastname']));
$record['suffix'] = mysqli_real_escape_string($connection, trim($_POST['suffix']));
$record['gender'] = mysqli_real_escape_string($connection, trim($_POST['gender']));
$record['dob'] = mysqli_real_escape_string($connection, trim($_POST['dob']));
$record['marital'] = mysqli_real_escape_string($connection, trim($_POST['marital']));
$record['employement'] = mysqli_real_escape_string($connection, trim($_POST['employement']));
$record['employer'] = mysqli_real_escape_string($connection, trim($_POST['employer']));
$record['email'] = mysqli_real_escape_string($connection, trim($_POST['email']));

$record['street'] = mysqli_real_escape_string($connection, trim($_POST['street']));
$record['city'] = mysqli_real_escape_string($connection, trim($_POST['city']));
$record['state'] = mysqli_real_escape_string($connection, trim($_POST['state']));
$record['zip'] = mysqli_real_escape_string($connection, trim($_POST['zip']));
$record['telephone'] = mysqli_real_escape_string($connection, trim($_POST['telephone']));
$record['mobile'] = mysqli_real_escape_string($connection, trim($_POST['mobile']));
$record['fax'] = mysqli_real_escape_string($connection, trim($_POST['fax']));

$query = "UPDATE details 
	SET firstname = '" . $record['firstname'] . "', middlename = '" . $record['middlename'] . "', lastname = '" . $record['lastname'] . 
	"', suffix = '" . $record['suffix'] . "', gender = '" . $record['gender'] . "', dob = '" . $record['dob'] . 
	"', marital = '" . $record['marital'] . "', employement = '" . $record['employement'] . "',employer = '" . $record['employer'] . 
	"', email = '" . $record['email'] . "', street = '" . $record['street'] . "', city = '" . $record['city'] . "', state = '" . $record['state'] . 
	"', zip = '" . $record['zip'] . "', telephone = '" . $record['telephone'] . "', mobile = '" . $record['mobile'] . "', fax = '" . $record['fax'] .
	"' WHERE username = '$username'";
	$sql = mysqli_query($connection, $query);

	if($sql) {
        $status = array('status' => '1');
        echo json_encode($status);
    }
    else {
        $status = array('status' => $connection->error);
        echo json_encode($status);
    }
?>