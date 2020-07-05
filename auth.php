<?php
session_start();
require './config.php';
require './connect.php';
//ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'] .'/sessions/');

$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
$login = $data->login;
$password = md5($data->password . $login);
$arraySel = array('login' => $login);
$passBase = $pdo->prepare("SELECT `password` FROM users WHERE login=:login");
$passBase-> execute($arraySel);
$res = $passBase->fetch(PDO::FETCH_ASSOC);

if(isset($login) && ($password)){
    if ($password === $res['password']) {
        $userDataQuery = $pdo->prepare("SELECT `userId`, `login`, `role`, `photo` FROM users WHERE login=:login");
        $userDataQuery->execute($arraySel);
        $userData = $userDataQuery->fetch(PDO::FETCH_ASSOC);
        $_SESSION['userId'] = $userData['userId'];
        
        session_write_close();
        if ($_SESSION['userId']) {
            echo json_encode($userData);            
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden1');
            session_destroy();
            exit;
        }
    } else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden2');
        session_destroy();
        exit;
    }
}
else{
    echo 'options';
    session_destroy();
    exit;
}