<?php

$servername = "localhost";
$dbusername = "placeholderusername";
$dbpassword = "placeholderpassword";
$dbname = "placeholderdatabase";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}