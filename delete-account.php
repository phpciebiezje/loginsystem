<?php
    include_once 'header.php';
    if(isset($_SESSION['userUid'])){
        echo "<p>Hello ".$_SESSION['userUid']."</p>";
    }
?>
    <h2>Fill in the fields to delete account</h2>
    <form action="inc/delete-account-inc.php" method="post">
        <p><input type="text" name="user" placeholder="Username/Email"></p>
        <p><input type="password" name="pwd" placeholder="Password"></p>
        <p style="color:red;">Pressing the button below will permanently delete your account and you won't be able to recover it</p>
        <button type="submit" name="delete">DELETE ACCOUNT</button>
    </form>
<?php
    include_once 'footer.php';
?>