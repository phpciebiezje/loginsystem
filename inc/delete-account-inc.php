<?php
if(!isset($_POST['delete'])){
    header("location: ../index.php");
}
else{
    $user=$_POST['user'];
    $pwd=$_POST['pwd'];

    if(empty($user) or empty($pwd)){
        header("location: ../delete-account.php?error=emptyinput");
        exit();
    }

    require_once "connect-inc.php";
    require_once "functions-inc.php";

    if(uidExists($connect, $user, $user)===false){
        header("location: ../delete-account.php?error=userdoesntexist");
        exit();
    }
    else{
        $uidExists=uidExists($connect, $user, $user);
        $pwdHashed=$uidExists['userPwd'];
        $pwdCheck=password_verify($pwd, $pwdHashed);
        if($pwdCheck===false){
            header("location: ../delete-account.php?error=wrongpassword");
            exit();
        }
        $sql="DELETE FROM users WHERE userUid=? OR userEmail=?;";
        $stmt=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../delete-account.php?error=stmterror");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $user, $user);
        mysqli_stmt_execute($stmt);
        session_start();
        session_unset();
        session_destroy();
        header("location: ../index.php");
    }
}


