<?php
    include_once 'header.php';
?>
    <div id="content">
        <?php
            $selector=$_GET['selector'];
            $validator=$_GET['validator'];
            echo $selector."<br>";
            echo $validator;
            if(empty($selector) or empty($validator)){
                echo "<p>We could not validate your request</p>";
            }
            else{
                if(ctype_xdigit($selector)!==false and ctype_xdigit($validator)!==false){
                    echo "
                    <form action='inc/create-new-pwd-inc.php' method='post'>
                        <input type='hidden' name='selector' value='$selector'>
                        <input type='hidden' name='validator' value='$validator'>
                        <p><input type='password' name='new-pwd' placeholder='Enter a new password'></p>
                        <p><input type='password' name='new-pwd-repeat' placeholder='Repeat new password'></p>
                        <p><button type='submit' name='reset-pwd'>Reset password</button></p>
                    </form>";


                    
                }
            }
        ?>
    </div>
<?php
    include_once 'footer.php'
?>