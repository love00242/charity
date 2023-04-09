<?php
    $dsn="mysql:host=127.0.0.1;port=3306;dbname=event;charset=utf8";
    $user="member";
    $password="member123";
    $options=array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);
    $pdo=new pdo($dsn,$user,$password,$options);
?>