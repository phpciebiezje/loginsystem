<?php
    if(!isset($_POST['reset-pwd'])){
        header("location: ../index.php");
    }
    else{
        $selector=$_POST['selector'];
        $validator=$_POST['validator'];
        $newPwd=$_POST['new-pwd'];
        $newPwdRepeat=$_POST['new-pwd-repeat'];

        if(empty($newPwd) || empty($newPwdRepeat)){
            header("location: ../create-new-pwd.php?selector=$selector&validator=$validator)&error=emptyinput");
            exit();
        }
        else if($newPwd !== $newPwdRepeat){
            header("location: ../create-new-pwd.php?error=pwddontmatch");
            exit();
        }
        $currentDate=date("U");
        require 'connect-inc.php';
        $sql="SELECT * FROM pwdReset WHERE resetSelector=? AND resetExpires>=$currentDate;";
        $stmt=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "<p>Unexpected error occured. Try again later</p>";
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $selector);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            if(!$row=mysqli_fetch_assoc($result)){
                echo "You need to re-submit your reset request";
                exit();
            }
            else{
                $tokenBin=hex2bin($validator);
                $tokenCheck=password_verify($tokenBin, $row['resetToken']);

                if($tokenCheck===false){
                    echo "You need to re-submit your reset request";
                    exit();
                }
                else if($tokenCheck===true){
                    $tokenEmail=$row['resetEmail'];
                    $sql="SELECT * FROM users WHERE userEmail=?;";
                    $stmt=mysqli_stmt_init($connect);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "<p>Unexpected error occured. Try again later</p>";
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                        mysqli_stmt_execute($stmt);
                        $result=mysqli_stmt_get_result($stmt);
                        if(!$row=mysqli_fetch_assoc($result)){
                            echo "There was an error";
                            exit();
                        }
                        else{
                            $sql="UPDATE users SET userPwd=? WHERE userEmail=?;";
                            $stmt=mysqli_stmt_init($connect);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                echo "<p>Unexpected error occured. Try again later</p>";
                                exit();
                            }
                            else{
                                $hashedPwd=password_hash($newPwd, PASSWORD_DEFAULT);
                                mysqli_stmt_bind_param($stmt, "ss",$hashedPwd ,$tokenEmail);
                                mysqli_stmt_execute($stmt);

                                $sql="DELETE FROM pwdreset WHERE resetEmail=?;";
                                $stmt=mysqli_stmt_init($connect);
                                if(!mysqli_stmt_prepare($stmt, $sql)){
                                    echo "<p>Unexpected error occured. Try again later</p>";
                                    exit();
                                }
                                else{
                                    $hashedPwd=password_hash($newPwd, PASSWORD_DEFAULT);
                                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                    mysqli_stmt_execute($stmt);
                                    header("location: ../login.php?newpwd=passwordupdated");
                                }
                            }
                        }
                    }   
                }
            }
        }
    }