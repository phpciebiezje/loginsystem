<?php
    function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
        if(empty($name) or empty($email) or empty($username) or empty($pwd) or empty($pwdRepeat)){
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }

    function invalidUid($username){
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }

    function invalidEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }

    function pwdMatch($pwd, $pwdRepeat){
        if($pwd!==$pwdRepeat){
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }

    function uidExists($connect, $username, $email){
        $sql="SELECT * FROM users WHERE userUid=? OR userEmail=?;";
        $stmt=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        $resultData=mysqli_stmt_get_result($stmt);
        if($row=mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $result=false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }
    function createUser($connect, $name, $email, $username, $pwd){
        $sql="INSERT INTO users (userName, userEmail, userUid, userPwd) VALUES (?,?,?,?);";
        $stmt=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        $hashedPwd=password_hash($pwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../signup.php?error=none");
        exit();
    }
    function emptyInputLogin($username, $pwd){
        if(empty($username) or empty($pwd)){
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }
    function loginUser($connect, $username, $pwd){
        $uidExists=uidExists($connect, $username, $username);
        if($uidExists===false){
            header("location: ../login.php?error=loginerror");
            exit();
        }

        $pwdHashed=$uidExists['userPwd'];
        $checkPwd=password_verify($pwd, $pwdHashed);

        if($checkPwd===false){
            header("location: ../login.php?error=wrongpassword");
            exit();
        }
        else if($checkPwd===true){
            session_start();
            $_SESSION['userId']=$uidExists['userId'];
            $_SESSION['userUid']=$uidExists['userUid'];
            header("location: ../index.php");
            exit();
        }
    }

