<?php
ob_start();
session_start();
$dbServername = "localhost";
$dbUsername = "neeraj";
$dbPassword = "mindfire";
$dbName = "emp";
// Create connection
$connection = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
// Check connection
if ($connection->connect_error) {
    $_SESSION['message'] = "Unable to connect to the database.<br>This application will not be able to serve you.";
}
require('header.php');
?>