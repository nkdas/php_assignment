<?php
$dbServername = "localhost";
$dbUsername = "neeraj";
$dbPassword = "mindfire";
$dbName = "emp";
// Create connection
$connection = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
require('header.php');
ob_start();
session_start();
?>