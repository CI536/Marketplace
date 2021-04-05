<?php
ob_start();
session_start();
if(isset($_POST['biosubmit']) || isset($_POST["profilesubmit"]) || isset($_POST["marketplacesubmit"]) || isset($_POST["newlistingsubmit"]))
{
    require 'dbh.inc.php';
	$redirect_url = "http://".$_SERVER['SERVER_NAME']."/CI536/studentportal.php"; //Redirect URL after submit the form

    if (isset($_POST["newlistingsubmit"])){
        $listingimgupload = $_FILES['listingimgupload'];
        $listingimgnameupload = $_FILES['listingimgupload']['name'];
        $listingimgtmpnameupload = $_FILES['listingimgupload']['tmp_name'];
        $listingimgsizeupload = $_FILES['listingimgupload']['size'];
        $listingimgerrorupload = $_FILES['listingimgupload']['error'];
        $listingimgtypeupload = $_FILES['listingimgupload']['type'];
        $fileExt = explode('.', $listingimgnameupload);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = array('jpg', 'jpeg');
        if (in_array($fileActualExt, $allowedExt)){
            if ($listingimgerrorupload === 0){
                if ($listingimgsizeupload < 500000){
                    $fileNameNew = uniqid('', true);
                    $fileDest = '../studentdata/'.$_SESSION['pathName'].'/marketplace/'.$fileNameNew.".".$fileActualExt;
                    move_uploaded_file($listingimgtmpnameupload, $fileDest);

                    $sql = 'INSERT INTO marketplace (studentID, listingName, fileName, listingBio, listingPrice) VALUES (?, ?, ?, ?, ?)';
                    if (isset($conn)) {
                        $stmt = mysqli_stmt_init($conn);
                    }else{
                        header("Location: ".$redirect_url."?uploadinitsqlerror");
                        exit();
                    }
                    if (!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ".$redirect_url."?uploadprepsqlerror");
                        exit();
                    }else{
                        mysqli_stmt_bind_param($stmt, "isssi", $_SESSION['studentID'], $_POST['listingtitleupload'], $fileNameNew, $_POST['listingbioupload'], $_POST['listingpriceupload']);
                        mysqli_stmt_execute($stmt);
                        header("Location: ".$redirect_url."?uploadSuccessful");
                        exit();
                    }
                }else{
                    echo "file size to large";
                }
            }else{
                echo "There was an error with the image file";
            }
        }else{
            echo "Wrong File extension type";
        }
    }

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
		$rpext = substr($_FILES['listingimgupdate']['name'],strpos($_FILES['listingimgupdate']['name'], '.'),strlen($_FILES['listingimgupdate']['name']));
		if (!empty($_POST["listingbioupdate"]) && !empty($_POST["listingimgupdate"])) {
			$subject = "listing content update submission from ".$_SESSION['studentName'];
			if ($_FILES['listingimgupdate']["error"] !== 4) {
				$mail->AddAttachment($_FILES['listingimgupdate']['tmp_name'],$_FILES['listingimgupdate']['name']="profile".$rpext);
				$message = "User has requested to update thier listing image. Find attached.";
				echo '<pre>'. print_r($_FILES['listingimgupdate'], 1). '</pre>';
				echo "listing image success...";
			}
			if (!empty($_POST["listingbioupdate"])) {
				$message .= "<br>User has requested to update thier listing bio.<br><br> <b>listing ID:</b><br>".$_GET['listingIndex']."<br><br></b><b>New Bio:</b><br>".test_input($_POST["listingbioupdate"]);
				echo "listing bio success...";
			}
		}else{
			echo "listing content empty...";
			header("Location: ".$redirect_url."?emptymarketplaces");
		}
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