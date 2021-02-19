<?
ob_start();
if(isset($_POST['btnSubmit']))
{
	require("placeholder/php/class.phpmailer.php");

	$mail = new PHPMailer();
	$name_error = $email_error = false;
	$name = $email = $reason = $message = "";

	//Your SMTP servers details

	$mail->IsSMTP();               // set mailer to use SMTP
	$mail->Host = "placeholderMailServer";  // specify main and backup server or localhost
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "web@placeholderEmail";  // SMTP username
	$mail->Password = "placeholderPassword"; // SMTP password
	//It should be same as that of the SMTP user

	$redirect_url = "http://".$_SERVER['SERVER_NAME']."/contact.html"; //Redirect URL after submit the form

	// name validation
	if (!empty($_POST["fullname"])) {
		$name = test_input($_POST["fullname"]);
		// check if name only contains letters and spaces
		if(!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$name_error = true;
		}
	}
	// email validation
	if (!empty($_POST["email"])) {
		$email = test_input($_POST["email"]);
		// check if email is well formed
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email_error = true;
		}
	}
	// message validation
	if (!empty($_POST["query"])) {
		$message = test_input($_POST["query"]);
	}
	// subject validation
	if (!empty($_POST["subject"])) {
		$subject = test_input($_POST["subject"]);
	}

	$mail->From = $mail->Username;	//Default From email same as smtp user
	$mail->FromName = $_POST['fullname']." - ".$_POST['email'];

	//Email address where you wish to receive/collect those emails.
	$reason = $_POST['reason'];
	switch ($reason) {
		case 1:
			$mail->AddAddress("general@placeholderEmail", "General Enquiries");
			break;

		case 2:
		$mail->AddAddress("ar@placeholderEmail", "Student Relations");
			break;

		case 3:
		$mail->AddAddress("payouts@placeholderEmail", "Payout Enquiries");
			break;

		case 4:
		$mail->AddAddress("techsupport@placeholderEmail", "Technical Support");
			break;

		default:
		$mail->AddAddress("tim@placeholderEmail", "Tim");
		echo "recipient error";
			break;
	}

	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	$mail->IsHTML(true);                                  // set email format to HTML

	if($name_error == false and $email_error == false){
		$mail->Subject = $subject;
		$message_body = "<b>Name of the author:</b> <br>".$name." \r\n <br><b>Email Adrress: </b><br>".$email." \r\n <br> <b>Message:</b> <br>".$message;
		$mail->Body    = $message_body;

		if(!$mail->Send())
		{
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . $mail->ErrorInfo;
		   exit;
		}
		echo "Message has been sent";
	}
	header("Location: ".$redirect_url);
}
function test_input($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>