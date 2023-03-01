<?php
    if(isset($_POST['submit'])){
        $username=$_POST['name'];
        $pwd=$_POST['pwd'];
        require_once 'connect-inc.php';
        require_once 'functions-inc.php';

        if(emptyInputLogin($username, $pwd)!==false){
            header("location: ../login.php?error=emptyinput");
            echo "<p>Fill in all fields!</p>";
            exit();
        }

        loginUser($connect, $username, $pwd);
    }
    else{
        header("location: ../login.php");
        exit();
    }
