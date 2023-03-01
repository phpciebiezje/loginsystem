<?php
    include_once 'header.php';
?>
    <div id="content">
        <h2>Reset your password</h2>
        <p>An e-mail will be send to you with instructions on how to reset your password</p>
        <form action="inc/reset-pwd-inc.php" method="post">
            <p><input type="text" name="email" placeholder="Enter your email address"></p>
            <button type="submit" name="reset">Receive new password</button>
        </form>
        <?php
            if(isset($_GET['reset'])){
                if($_GET['reset']==="success"){
                    echo "<p>Check your email!</p>";
                }
            }
        ?>
    </div>
<?php
    include_once 'footer.php'
?>