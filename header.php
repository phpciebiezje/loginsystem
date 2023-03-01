<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="heder">
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
                if(isset($_SESSION['userUid'])){
                    echo "<li><a href='profile.php'>Profile page</a></li>
                          <li><a href='account-settings.php'>Account settings</a></li>
                          <li><a href='inc/logout-inc.php'>Log out</a></li>";
                }
                else{
                    echo "<li><a href='signup.php'>Sign up</a></li>
                    <li><a href='login.php'>Log in</a></li>";
                }
            ?>
        </ul>
    </div>
    <div id="content">