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
    
    move_uploaded_file($_FILES['sendFile']['tmp_name'], 'uploads/chapterCovers/' .$unicName);
    
    $entityId = $_POST['entityId'];

    $arrQuery = ["cover"=>$unicName, "entityId"=> $entityId];
    $fileNameUpdateQuery = $pdo->prepare("UPDATE chapters SET cover =:cover WHERE id =:entityId");
    $fileNameUpdateQuery->execute($arrQuery);
}