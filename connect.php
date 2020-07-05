<?php
require './setHeaders.php';
$dsn="mysql:host=$host; dbname=$db; charset=$charset";
$option=array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC);
$pdo=new PDO($dsn, $user, $pass, $option);