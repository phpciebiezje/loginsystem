<?php
    $serverName="localhost";
    $dbUser="root";
    $dbPwd="";    
    $dbName="loginsystem";
    $connect=mysqli_connect($serverName, $dbUser, $dbPwd, $dbName);
    if(!$connect){
        die("Connection failed: ".mysqli_connect_error());
    }
