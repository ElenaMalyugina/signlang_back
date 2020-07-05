<?php
require './config.php';
require './connect.php';

$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
$login = $data->login;
$password = md5($data->password . $login);
$firstName = $data->firstName;
$lastName =$data->lastName;

if(isset($data->photo)){
    $photo = $data->photo;
}
else{
    $photo = '';
}

$role =$data->role;
$userId = uniqid();

$arrLog=['login'=>$login];
$isLoginQuery= $pdo->prepare("SELECT COUNT(*) as total FROM users WHERE login=:login");
$isLoginQuery->execute($arrLog);
$isLoginInBase = $isLoginQuery->fetch(PDO::FETCH_ASSOC);

if($isLoginInBase['total']>0){
    header($_SERVER['SERVER_PROTOCOL'] . ' 415 UserExists');
    exit;
}
else{
    $arraySel = [
        'userId'=>$userId,
        'login' => $login, 
        'password'=>$password, 
        'firstName'=>$firstName, 
        'lastName'=>$lastName, 
        'role'=>$role, 
        'photo'=>$photo
    ];

    $passBase = $pdo->prepare("INSERT INTO users VALUES (:userId, :login, :password, :role, :firstName, :lastName, :photo)");
    $passBase-> execute($arraySel);

    $arr2=['userId'=>$userId];
    $loginBase = $pdo->prepare("SELECT login FROM users WHERE userId=:userId");
    $loginBase->execute($arr2);

    $userLogin = $loginBase->fetch(PDO::FETCH_ASSOC);
    
    $resp = (object) array('id' => $userId);
    echo json_encode($resp);
}

