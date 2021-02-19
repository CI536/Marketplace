<?php
session_start();
if (isset($_POST['payout-submit']) && $_POST['earningsdisplay'] !== "Payout in Proccess...") {
	$currentDate = date('Y-m-d');
	require 'dbh.inc.php';

	$sql = "INSERT INTO `payoutRequests` (`studentID`, `date`, `earnings`, `paid`) VALUES (".$_SESSION['studentID'].", '".$currentDate."', ".$_POST['earnings'].", '0');";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: studentportal.php?error=sqlerror");
		exit();
	}else{
		mysqli_stmt_execute($stmt);
	}
	require("class.phpmailer.php");
	$mail = new PHPMailer();
	$name_error = $email_error = false;
	//Your SMTP servers details
	$mail->IsSMTP();               // set mailer to use SMTP
	$mail->Host = "placeholderMailServer";  // specify main and backup server or localhost
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "web@placeholderEmail";  // SMTP username
	$mail->Password = "placeholderPassword"; // SMTP password
	//It should be same as that of the SMTP user
	$redirect_url = "http://".$_SERVER['SERVER_NAME']."/php/studentportal.php?payment=requested";

	$mail->From = $mail->Username;	//Default From email same as smtp user
	$mail->FromName = $_SESSION['studentName'];

	//Email address where you wish to receive/collect those emails.
	$mail->AddAddress("tim@placeholderEmail", "Tim");

	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	$mail->IsHTML(true);

	$mail->Subject = "Payout request from ".$_SESSION['studentName'];
	$message_body = "<b>student:</b><br>".$_SESSION['studentName']."<br> \r\n <br><b>Name:</b><br>".$_SESSION['legalName']." \r\n <br><br><b>Email Adress:</b><br>".$_SESSION['email']."<br> \r\n <br> <b>Message:</b><br>A payout request has been made.<br><br><b>students Payout Value</b><br>&pound; ".$_POST['earnings'];
	$mail->Body    = $message_body;

	if(!$mail->Send()){
   		echo "Message could not be sent. <p>";
		echo "Mailer Error: " . $mail->ErrorInfo;
	   	exit;
	}

	echo "Message has been sent";
	header("location: studentportal.php");
	exit();
}else{
	header("location: studentportal.php");
	exit();
}