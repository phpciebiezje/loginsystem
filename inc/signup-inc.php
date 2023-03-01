<?php
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $username=$_POST['user'];
        $pwd=$_POST['pwd'];
        $pwdRepeat=$_POST['pwd-repeat'];

        require_once 'connect-inc.php';
        require_once 'functions-inc.php';
        if(emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)!==false){
            header("location: ../signup.php?error=emptyinput");
            echo "<p>Fill in all fields!</p>";
            exit();
        }
        if(invalidUid($username)!==false){
            header("location: ../signup.php?error=invaliduid");
            exit();
        }
        if(invalidEmail($email)!==false){
            header("location: ../signup.php?error=invalidemail");
            exit();
        }
        if(pwdMatch($pwd, $pwdRepeat)!==false){
            header("location: ../signup.php?error=pwdnotmatch");
            exit();
        }
        if(uidExists($connect, $username, $email)!==false){
            header("location: ../signup.php?error=usernametaken");
            exit();
        }
        createUser($connect, $name, $email, $username, $pwd);
    }
    else{
        header("location: ../signup.php");
        exit();
    }