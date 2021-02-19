<?php
if (isset($_POST['newpass-submit'])) {
	$selector = $_POST['selector'];
	$validator = $_POST['validator'];
	$password = $_POST['pwd'];
	$passwordrepeat = $_POST['pwd-repeat'];
	if (empty($password) || empty($passwordrepeat)) {
		header("Location: ../newpass.php?newpwd=empty");
		exit();
	}else if ($password !== $passwordrepeat) {
		header("Location: ../newpass.php?newpwd=pwdnotsame");
		exit();
	}
	$currentdate = date("U");

	require 'dbh.inc.php';

	$sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >=".$currentdate.";";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "mysql connection error 0";
		exit();
	}else{
		mysqli_stmt_bind_param($stmt, "s", $selector);
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		if (!$row = mysqli_fetch_assoc($result)) {
			echo "Request Failed";
			exit();
		}else{
			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);

			if ($tokenCheck === false) {
				echo '<p>You must reset your request.<br>
				<a href="../resetpass.html">Go Back</a></p>';
			exit();
			}else if ($tokenCheck === true) {
				$tokenEmail = $row['pwdResetEmail'];
				$sql = "SELECT * FROM students WHERE email = ?";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo "mysql connection error 1";
					exit();
				}else{
					mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if (!$row = mysqli_fetch_assoc($result)) {
						echo "There was an error!";
						exit();
					}else{
						$sql = "UPDATE students SET password = ? WHERE email = ?";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo "mysql connection error 2";
							exit();
						}else{
							$newpwdhash = password_hash($password, PASSWORD_DEFAULT);
							mysqli_stmt_bind_param($stmt, "ss", $newpwdhash, $tokenEmail);
							mysqli_stmt_execute($stmt);
							$sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
							$stmt = mysqli_stmt_init($conn);
							if (!mysqli_stmt_prepare($stmt, $sql)) {
								echo "mysql connection error 3";
								exit();
							}else{
								mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
								mysqli_stmt_execute($stmt);
								header("Location: newpass.php?newpwd=passwordupdated");
							}
						}
					}
				}
			}
		}
	}
}else{
	header("Location: ../index.html");
}
?>