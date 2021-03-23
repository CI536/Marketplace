<?php

$servername = "brighton";
$dbusername = "your uni id";
$dbpassword = "yourunipass";
$dbname = "your database name";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
