<?php

if (isset($_POST['newpass-submit'])) {
	$selector = $_POST['selector'];
	$validator = $_POST['validator'];
	$password = $_POST['pwd'];
	$passwordrepeat = $_POST['pwd-repeat'];

	if (empty($password) || empty($passwordrepeat)) {
		header("Location: ../newpass.php?newpwd=empty")
		exit();
	}else if ($password !== $passwordrepeat) {
		header("Location: ../newpass.php?newpwd=pwdnotsame")
		exit();
	}

	$currentdate = date("U");

	require '../dbh.inc.php';

	$sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "mysql connection error";
		exit();
	}else{
		mysqli_stmt_bind_param($stmt, "s", $selector, $currentdate);
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		if (!$row = mysqli_fetch_assoc($result)) {
			echo "You must reset your request.";
			exit();
		}else{
			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);

			if ($tokenCheck === false) {
				echo "You must reset your request.";
			exit();
			}else if ($tokenCheck === true) {
				$tokenEmail = $row['pwdResetEmail'];
				$sql = "SELECT * FROM artists WHERE email = ?";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo "mysql connection error";
					exit();
				}else{
					mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if (!$row = mysqli_fetch_assoc($result)) {
						echo "There was an error!";
						exit();
					}else{
						$sql = "UPDATE artists SET password = ? WHERE email = ?";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo "mysql connection error";
							exit();
						}else{
							$newpwdhash = password_hash($password, PASSWORD_DEFAULT);
							mysqli_stmt_bind_param($stmt, "ss", $newpwdhash, $tokenEmail);
							mysqli_stmt_execute($stmt);
							$sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
							$stmt = mysqli_stmt_init($conn);
							if (!mysqli_stmt_prepare($stmt, $sql)) {
								echo "mysql connection error";
								exit();
							}else{
								mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
								mysqli_stmt_execute($stmt);
								header("Location: ../newpass.php?newpwd=passwordupdated");
							}
						}
					}
				}
			}
		}
	}
}else{
	header("Location: ../../index.php")
}

?>