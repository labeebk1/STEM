<?php
//db details
$dbHost = '35.185.41.223';
$dbUsername = 'root';
$dbPassword = 'nickonly';
$dbName = 'STEM';

//Connect and select the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>