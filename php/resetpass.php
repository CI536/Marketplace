<?php
ob_start();
if (isset($_POST['resetpass-submit'])){

	$selector = bin2hex(byteGen(8));
	$token = byteGen(32);
	$url = "http://".$_SERVER['SERVER_NAME']."/php/newpass.php?selector=".$selector."&validator=".bin2hex($token);
	$expires = date("U") + 1800;
	$useruid = $_POST['mailuid'];

	require 'dbh.inc.php';

	if (empty($useruid)) {
		header("location: ../resetpass.html");
		exit();
	}else{
		$sql = "SELECT email FROM students WHERE email = ?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../resetpass.html?error=sqlerror");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt, "s", $useruid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)){
				$sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo "mysql connection error";
					exit();
				}else{
					mysqli_stmt_bind_param($stmt, "s", $useruid);
					mysqli_stmt_execute($stmt);
				}
				$sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES(?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo "mysql connection error";
					exit();
				}else{
					$hashedToken = password_hash($token, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt, "ssss", $useruid, $selector, $hashedToken, $expires);
					mysqli_stmt_execute($stmt);
				}

				mysqli_stmt_close($stmt);
				mysqli_close();

				require("class.phpmailer.php");
				$mail = new PHPMailer();
				//Your SMTP servers details
				$mail->IsSMTP();               // set mailer to use SMTP
				$mail->Host = "placeholderMailServer";  // specify main and backup server or localhost
				$mail->SMTPAuth = true;     // turn on SMTP authentication
				$mail->Username = "web@placeholderEmail";  // SMTP username
				$mail->Password = "placeholderPassword"; // SMTP password
				//It should be same as that of the SMTP user


				$mail->From = $mail->Username;	//Default From email same as smtp user
				$mail->FromName = "web@placeholderEmail";

				//Email address where you wish to receive/collect those emails.
				$mail->AddAddress($useruid, "placeholder student");

				$mail->WordWrap = 50;                                 // set word wrap to 50 characters
				$mail->IsHTML(true);                                  // set email format to HTML

				$mail->Subject = "Sata Records - Password reset request";
				$message_body = '<p> We recieved a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email.</p><br><p>Here is your password reset link:</p><br><a href="'.$url.'">'.$url.'</a>';
				$mail->Body = $message_body;

				if(!$mail->Send()) {
				   echo "Message could not be sent.";
				   echo "Mailer Error: " . $mail->ErrorInfo;
				   exit;
				}else{
					echo "Message has been sent";
				}
				header("Location: http://".$_SERVER['SERVER_NAME']."/resetpass.html?resetrequest=success");
			}else{
				header("location: ../resetpass.html");
				exit();
			}
		}
	}
}else{
	header("Location: ../resetpass.html");
}
function byteGen($i) {
	$bytes = '';
	while (strlen($bytes) < $i){
	  $bytes .= chr(mt_rand(0, 255));
	}
	return $bytes;
}
?>