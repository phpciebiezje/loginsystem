<?php
    include_once 'header.php';
    if(isset($_SESSION['userUid'])){
        echo "<p>Hello ".$_SESSION['userUid']."</p>";
    }
?>
    <p><a href="delete-account.php">Delete account</a></p>
<?php
    include_once 'footer.php';
?>