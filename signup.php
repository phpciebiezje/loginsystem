<?php
    include_once 'header.php';
?>
    <div class="signup-form">
        <h2>Sign up</h2>
        <form action="inc/signup-inc.php" method="post">
            <input type="text" name="name" placeholder="Full name">
            <input type="text" name="email" placeholder="E-Mail">
            <input type="text" name="user" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd-repeat" placeholder="Repeat password">
            <button type="submit" name="submit">Sign up</button>
        </form>
    </div>
<?php
    if(isset($_GET['error'])){
        if($_GET["error"]=="emptyinput"){
            echo "<p>Fill in all fields</p>";
        }
        else if($_GET["error"]=="invaliduid"){
            echo "<p>Username is not correct</p>";
        }
        else if($_GET["error"]=="invalidemail"){
            echo "<p>Email is not correct</p>";
        }
        else if($_GET["error"]=="pwdnotmatch"){
            echo "<p>Passwords does not match</p>";
        }
        else if($_GET["error"]=="usernametaken"){
            echo "<p>Username already taken</p>";
        }
        else if($_GET["error"]=="stmtfailed"){
            echo "<p>Something went wrong</p>";
        }
        else if($_GET["error"]=="none"){
            echo "<p>You have signed up!</p>";
        }
    }
?>
<?php
    include_once 'footer.php';
?>