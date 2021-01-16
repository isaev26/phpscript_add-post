<?php

$server = 'localhost';
$sname = 'mono_bd2';
$suser = 'root';
$spass = '';

try {
    $conn = new PDO("mysql:host=$server; dbname=$sname", $suser, $spass);
    echo 'Connected';
}catch (PDOException $exception){
    $conn = new PDO("mysql:host=$server", $suser, $spass);

    $conn->exec("CREATE DATABASE `$sname`;
            CREATE USER '$suser'@'localhost' IDENTIFIED BY '$spass';
            GRANT ALL ON `$sname`.* TO '$suser'@'localhost';
            FLUSH PRIVILEGES;")
    or die(print_r($conn->errorInfo(), true));
    header("Refresh:0");
    echo $exception->getMessage();
}

?>
