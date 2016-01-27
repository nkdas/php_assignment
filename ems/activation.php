<?php
require_once('db_connection.php');
// get user id from the the url
$userId = $_GET['id'];
$activation_key = $_GET['key'];

$query= mysqli_query($connection, "SELECT username 
                        			FROM details 
                        			WHERE activation_key = '$activation_key' AND id = '$userId'");
if ($query and $row = mysqli_fetch_assoc($query)) {
	// update the activation field of the user details to 1
	$query = mysqli_query($connection, "UPDATE details SET activation = 1
       									WHERE id = $userId");
	// if updation is successful, it means the user is activated
	if($query) {
		$_SESSION['message'] = "Your account is activated!<br>You are ready to Sign in.";
	    header("Location: index.php");
	}
}
?>