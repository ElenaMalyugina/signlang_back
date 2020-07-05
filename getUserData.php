<?php
require './config.php';
require './connect.php';

$userId = $_GET['id'];

$arrQuery = ['userId'=>$userId];

$userQuery = $pdo->prepare("SELECT `userId`, `login`, `role`, `firstName`, `lastName`, `photo` FROM users WHERE `userId`=:userId");
$userQuery->execute($arrQuery);

$userData = $userQuery->fetch(PDO::FETCH_ASSOC);

echo json_encode($userData); 