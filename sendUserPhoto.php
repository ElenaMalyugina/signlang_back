<?php
require './config.php';
require './connect.php';

if ( 0 < $_FILES['sendFile']['error'] ) {
    echo 'Error: ' . $_FILES['sendFile']['error'] . '<br>';
}
else {
    $parseFileName = explode('.', $_FILES['sendFile']['name']);
    $extFile = $parseFileName[count($parseFileName) - 1];    
    $unicName = uniqid() . '.' . $extFile;
    
    move_uploaded_file($_FILES['sendFile']['tmp_name'], 'uploads/userphoto/' .$unicName);
    
    $entityId = $_POST['entityId'];

    $arrQuery = ["photo"=>$unicName, "entityId"=> $entityId];
    $fileNameUpdateQuery = $pdo->prepare("UPDATE users SET photo =:photo WHERE userId=:entityId");
    $fileNameUpdateQuery->execute($arrQuery);

    echo json_encode(['fileName'=>$unicName]);
}