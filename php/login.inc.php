<?php

if (isset($_POST['login-submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

	require 'dbh.inc.php';

    // Checks if form has been submitted
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6LcjIrQZAAAAAOsK_9yappxrd-Dcx_Mb-OYm8vw0',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        header("location: ../login.html?error=recaptcha");
		exit();
    }else{
        $mailuid = $_POST['mailuid'];
		$password = $_POST['pwd'];

		if (empty($mailuid) || empty($password)) {
			header("location: ../login.html?error=emptyfields");
			exit();
		}else{
			$sql = "SELECT * FROM students LEFT JOIN marketplace ON students.studentID = marketplace.studentID WHERE email = ?;";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../login.html?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt, "s", $mailuid);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if ($row = mysqli_fetch_assoc($result)) {
					$pwdcheck = password_verify($password, $row['password']);
					if ($pwdcheck == false) {
						header("location: ../login.html?error=wrongpassword");
						exit();
					}else if($pwdcheck == true){
						session_start();
						$_SESSION['studentID'] = $row['studentID'];
						$_SESSION['studentName'] = $row['studentName'];
						$_SESSION['pathName'] = $row['pathName'];
						$_SESSION['studentBio'] = $row['studentBio'];
						$_SESSION['studentNumber'] = $row['studentNumber'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['listingID'] = $row['listingID'];
						header("location: studentportal.php?login=success");
						exit();
					}else{
						header("location: ../login.html?error=wrongpassword");
						exit();
					}
				}else{
					header("location: ../login.html?error=invaliduserdetails");
					exit();
				}
			}
		}
    }
}else{
	header("location: ../login.html?poo");
	exit();
}