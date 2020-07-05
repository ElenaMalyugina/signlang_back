<?php
require './config.php';
require './connect.php';

$passData = json_decode(file_get_contents('php://input'));
$login = $passData->login;
$oldPassword = md5($passData->oldPassword . $login);
$newPassword = md5($passData->newPassword . $login);

$checkOldPasswordArr= ['login'=>$login];

$checkOldPasswordQuery = $pdo->prepare('SELECT `password` FROM users WHERE `login`=:login');
$checkOldPasswordQuery->execute($checkOldPasswordArr);

$checkRes = $checkOldPasswordQuery->fetch(PDO::FETCH_ASSOC);

if($oldPassword == $checkRes['password']){
    $setNewPasswordArr = ['login'=>$login, 'newPassword'=>$newPassword];
    $setNewPasswordQuery = $pdo->prepare("UPDATE users SET `password`= :newPassword WHERE `login`=:login");
    $setNewPasswordQuery->execute($setNewPasswordArr);
    echo '{"res":"OK"}';
} else {
    //header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
    echo '{"res":"BAD"}';   
    exit;    
}

