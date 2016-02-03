<?php 
require_once('db_connection.php');

$username = mysqli_real_escape_string($connection, trim($_POST['username']));
$query = mysqli_query($connection, "DELETE FROM details 
                            WHERE username = '$username'");
if ($query) {
    $status = array('status' => '1');
    echo json_encode($status);
}
else {
    $status = array('status' => '2');
    echo json_encode($status);
}
?>