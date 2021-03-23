<?php
if(isset($_POST['signup-submit'])){
    require '../dbh.inc.php';

    $username = $_POST['uid'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&email".$email);
        exit();
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-z]*$/', $username)){
        header("Location: ../signup.php?error=invalidemailuid");
        exit();
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidemail&uid=".$username);
        exit();
    }else if (!preg_match('/^[a-zA-z]*$/', $username)){
        header("Location: ../signup.php?error=invaliduid&email=".$email);
        exit();
    }else if ($password !== $passwordRepeat){
        header("Location: ../signup.php?error=passnomatch&uid=".$username."&email".$email);
        exit();
    }else if (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/', $password)){
        header("Location: ../signup.php?error=invalidpass&uid=".$username."&email".$email);
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
        }
    }
}