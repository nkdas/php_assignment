<?php
require_once('db_connection.php');

// fetch username and password from $_POST
$username = mysqli_real_escape_string($connection, trim($_POST['username']));
$password = mysqli_real_escape_string($connection, trim($_POST['password']));
$password = md5($password);

$query = mysqli_query($connection, "SELECT id, activation
    FROM details 
    WHERE username = '$username' AND password = '$password'");

// if the query executes successfully then the user is registered and the credentials are valid
if ($query and $row = mysqli_fetch_assoc($query)) {
    // check if the account of the registered user is activated
    if($row['activation'] == 1) {
        
        // if the account of the user is activated, then create sessions for the user and display the users home page.
        $_SESSION['id'] = $row['id'];
        $status = array('status' => '1');
        echo json_encode($status);
    }
    else {
        $status = array('status' => '2');
        echo json_encode($status);
    }
}
else
{
    $status = array('status' => '3');
    echo json_encode($status);
}
?>