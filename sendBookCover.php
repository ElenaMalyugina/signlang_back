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
    
    move_uploaded_file($_FILES['sendFile']['tmp_name'], 'uploads/covers/' .$unicName);
    
    $entityId = $_POST['entityId'];

    $arrQuery = ["picture"=>$unicName, "entityId"=> $entityId];
    $fileNameUpdateQuery = $pdo->prepare("UPDATE books SET picture =:picture WHERE id=:entityId");
    $fileNameUpdateQuery->execute($arrQuery);

}