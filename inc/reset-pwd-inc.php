<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    if(isset($_POST['reset'])){
        $selector=bin2hex(random_bytes(8));
        $token=random_bytes(32);
        $url="localhost/php/logowanie/create-new-pwd.php?selector=$selector&validator=".bin2hex($token);
        $expires=date("U")+1800;
        require 'connect-inc.php';
        $userEmail=$_POST['email'];

        $sql="DELETE FROM pwdReset WHERE resetEmail=?;";
        $stmt=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "<p>Unexpected error occured. Try again later</p>";
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $userEmail);
            mysqli_stmt_execute($stmt);
        }
        $sql="INSERT INTO pwdReset (resetEmail, resetSelector, resetToken, resetExpires) VALUES (?,?,?,?);";
        $stmt=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "<p>Unexpected error occured. Try again later</p>";
            exit();
        }
        else{
            $hashedToken=password_hash($token, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        $to=$userEmail;
        $subject="Reset your password";
        $message="<p>We received a password reset request. The link to reset your password is below. If you didn't make this request, you can ignore this email</p>";
        $message.="<p>Here is your password reset link:<br>";
        $message.="<a href='$url'>$url</a></p>";

        $mail=new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username="email";
        $mail->Password="password";
        $mail->SMTPSecure="ssl";
        $mail->Port=465;
        $mail->setFrom("email");
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject=$subject;
        $mail->Body=$message;
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );
        $mail->send();
        header("location: ../reset-pwd.php?reset=success");
    }
    else{
        header("location: ../reset-pwd.php");
    }