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

    move_uploaded_file($_FILES['sendFile']['tmp_name'], 'uploads/images/' .$unicName);
    
    $resp = ['url'=> 'http://library/uploads/images/' .$unicName, 'uploaded': true];

    echo json_encode($resp);
}