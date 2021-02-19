<?php

$servername = "brighton";
$dbusername = "ta459";
$dbpassword = "!University-03841480";
$dbname = "ta459_CI536";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}