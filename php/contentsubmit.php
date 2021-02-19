<?
ob_start();
session_start();
if(isset($_POST['biosubmit']) || isset($_POST["profilesubmit"]) || isset($_POST["marketplacesubmit"]))
{
	require("class.phpmailer.php");
	$mail = new PHPMailer();
	$name_error = $email_error = false;
	$message = $subject = "";
	//Your SMTP servers details
	$mail->IsSMTP();               // set mailer to use SMTP
	$mail->Host = "placeholderMailServer";  // specify main and backup server or localhost
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "web@placeholderEmail";  // SMTP username
	$mail->Password = "placeholderPassword"; // SMTP password
	//It should be same as that of the SMTP user

	echo "mail connection success...";
	$redirect_url = "http://".$_SERVER['SERVER_NAME']."/php/studentportal.php"; //Redirect URL after submit the form

	if (isset($_POST["profilesubmit"])) {
		$pext = substr($_FILES['profileupdate']['name'],strpos($_FILES['profileupdate']['name'], '.'),strlen($_FILES['profileupdate']['name']));
		if ($_FILES['profileupdate']["error"] !== 4) {
			$subject = "Profile image update submission from ".$_SESSION['studentName'];
			$message = "User has requested to update thier profile picture. Find attached";
			$mail->AddAttachment($_FILES['profileupdate']['tmp_name'],$_FILES['profileupdate']['name']="profile".$pext);
			echo '<pre>'. print_r($_FILES['profileupdate'], 1). '</pre>';
			echo "profile image success...";
		}else{
			echo "profile image empty...";
			header("Location: ".$redirect_url."?emptyprofile");
		}
	}

	if (isset($_POST["biosubmit"])) {
		if (!empty($_POST["bioupdate"])) {
			$subject = "Biography update submission from ".$_SESSION['studentName'];
			$message = "User has requested to update thier profile bio.<br><br> <b>New Bio:</b><br>".test_input($_POST["bioupdate"]);
			echo "bio success...";
		}else{
			echo "bio empty...";
			header("Location: ".$redirect_url."?emptybio");
		}
	}

	if (isset($_POST["marketplacesubmit"])) {
		$rpext = substr($_FILES['marketplaceimgupdate']['name'],strpos($_FILES['marketplaceimgupdate']['name'], '.'),strlen($_FILES['marketplaceimgupdate']['name']));
		if (!empty($_POST["marketplacebioupdate"]) && !empty($_POST["marketplacebioupdate"])) {
			$subject = "marketplace content update submission from ".$_SESSION['studentName'];
			if ($_FILES['marketplaceimgupdate']["error"] !== 4) {
				$mail->AddAttachment($_FILES['marketplaceimgupdate']['tmp_name'],$_FILES['marketplaceimgupdate']['name']="profile".$rpext);
				$message = "User has requested to update thier marketplace image. Find attached.";
				echo '<pre>'. print_r($_FILES['marketplaceimgupdate'], 1). '</pre>';
				echo "marketplace image success...";
			}
			if (!empty($_POST["marketplacebioupdate"])) {
				$message .= "<br>User has requested to update thier marketplace bio.<br><br> <b>marketplace ID:</b><br>".$_GET['marketplaceIndex']."<br><br></b><b>New Bio:</b><br>".test_input($_POST["marketplacebioupdate"]);
				echo "marketplace bio success...";
			}
		}else{
			echo "marketplace content empty...";
			header("Location: ".$redirect_url."?emptymarketplaces");
		}
	}

	$mail->From = $mail->Username;	//Default From email same as smtp user
	$mail->FromName = $_SESSION['studentName'];

	//Email address where you wish to receive/collect those emails.
	$mail->AddAddress("tim@placeholderEmail", "Tim");

	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	$mail->IsHTML(true);                                  // set email format to HTML

	if($message !== ""){
		$mail->Subject = $subject;
		$message_body = "<b>student:</b><br>".$_SESSION['studentName']."<br> \r\n <br><b>Name:</b><br>".$_SESSION['legalName']." \r\n <br><br><b>Email Adress:</b><br>".$_SESSION['email']."<br> \r\n <br> <b>Message:</b><br>".$message;
		$mail->Body    = $message_body;

		if(!$mail->Send()) 
		{
		   echo "Message could not be sent.";
		   echo "Mailer Error: " . $mail->ErrorInfo;
		   exit;
		}else{
			echo "Message has been sent";
		}
		header("Location: ".$redirect_url."?sent");
	}else{
		echo '<pre>Message couldnt send. <br><a href="studentportal.php">Go Back</a></pre>';
	}
}else{
	echo '<pre>Mail attempt failed <br><a href="studentportal.php">Go Back</a></pre>';
}
function test_input($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}