<?php
if(isset($_POST['signup-submit'])){
    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $studentNumber = $_POST['studentNo'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if (empty($username) || empty($studentNumber) || empty($email) || empty($password) || empty($passwordRepeat)){
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&email=".$email."&studentNo=".$studentNumber);
        exit();
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-z]*$/', $username) && !preg_match('/^[0-9]*$/', $studentNumber)){
        header("Location: ../signup.php?error=invalidemailuidstudentNo");
        exit();
    }else if (!preg_match('/^[0-9]*$/', $studentNumber) && !preg_match('/^[a-zA-z]*$/', $username)){
        header("Location: ../signup.php?error=invaliduidstudentNo&email=".$email);
        exit();
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[0-9]*$/', $studentNumber)){
        header("Location: ../signup.php?error=invalidemailstudentNo&uid=".$username);
        exit();
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidemail&uid=".$username."&studentNo=".$studentNumber);
        exit();
    }else if(!preg_match('/^[0-9]*$/', $studentNumber)) {
        header("Location: ../signup.php?error=invalidstudentNo&email=".$email."&uid=".$username);
        exit();
    }else if (!preg_match("/^[a-z ,.'-]+$/i", $username)){
        header("Location: ../signup.php?error=invaliduid&email=".$email."&studentNo=".$studentNumber);
        exit();
    }else if ($password !== $passwordRepeat){
        header("Location: ../signup.php?error=passnomatch&uid=".$username."&email".$email."&studentNo=".$studentNumber);
        exit();
    }else if (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/', $password)){
        header("Location: ../signup.php?error=passnotsecure&uid=".$username."&email".$email."&studentNo=".$studentNumber);
        exit();
    }else{
        $sql = "SELECT email FROM students WHERE email=?";
        if (isset($conn)) {
            $stmt = mysqli_stmt_init($conn);
        }else{
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0){
                header("Location: ../signup.php?error=useralreadyexists");
                exit();
            }else{
                $sql = "SELECT email FROM students WHERE studentNumber=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt, "s", $studentNumber);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultCheck = mysqli_stmt_num_rows($stmt);
                    if ($resultCheck > 0) {
                        header("Location: ../signup.php?error=studentNoalreadyexists");
                        exit();
                    }else{
                        $hashPass = password_hash($password, PASSWORD_DEFAULT);
                        $pathName = preg_replace('/[^A-Za-z]/', '', strtolower($username));
                        $defaultBio = "Update your student Bio";
                        $sql = "INSERT INTO students (studentName, studentNumber, email, password, pathName, studentBio) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../signup.php?error=sqlerror");
                            exit();
                        }else{
                            mysqli_stmt_bind_param($stmt, "sissss", $username, $studentNumber, $email, $hashPass, $pathName, $defaultBio);
                            mysqli_stmt_execute($stmt);
                            header("Location: ../signup.php?signup=success");
                            exit();
                        }
                    }
                }
            }
        }
    }
}else{
    header("Location: ../signup.php?signup=bad");
    exit();
}