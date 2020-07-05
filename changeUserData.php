<?php
require './config.php';
require './connect.php';

$userData = json_decode(file_get_contents('php://input'));

$arrQuery = ['userId'=> $userData->userId, 'firstName'=> $userData->firstName, 'lastName'=>$userData->lastName];

$changeDataQuery = $pdo->prepare('UPDATE users SET firstName = :firstName, lastName=:lastName WHERE `userId`=:userId');
$changeDataQuery->execute($arrQuery);

$newDataArr = ['userId'=> $userData->userId];
$newDataQuery = $pdo->prepare("SELECT `userId`, `login`, `role`, `firstName`, `lastName`, `photo` FROM users WHERE `userId`=:userId");
$newDataQuery->execute($newDataArr);

$newUserData = $newDataQuery->fetch(PDO::FETCH_ASSOC);

echo json_encode($newUserData);
