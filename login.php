<?php
    include_once 'header.php';
?>
    <div class="login-form">
        <h2>Log in</h2>
        <?php
            if(isset($_GET['newpwd'])){
                if($_GET['newpwd']==="passwordupdated"){
                    echo "<p>You password has been successfully updated. Log in using a new password</p>";
                }
            }
        ?>
        <form action="inc/login-inc.php" method="post">
            <p><input type="text" name="name" placeholder="Username/E-Mail"></p>
            <p><input type="password" name="pwd" placeholder="Password"></p>
            <p><button type="submit" name="submit">Log in</button></p>
            <p><a href="reset-pwd.php">Forgot password?</a></p>
        </form>
        <?php
            if(isset($_GET['error'])){
                if($_GET['error']=="emptyinput"){
                    echo "<p>Fill in all fields</p>";
                }
                else if($_GET['error']=="loginerror"){
                    echo "<p>Username or email doesn't exist</p>";
                }
                else if($_GET['error']=="wrongpassword"){
                    echo "<p>Wrong password</p>";
                }
            }
        ?>
    </div>
<?php
    include_once 'footer.php';
?>