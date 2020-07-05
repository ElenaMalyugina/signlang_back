<?php
require './config.php';
require './connect.php';

$request_body = file_get_contents('php://input');
$book = json_decode($request_body);

$id = uniqid();
$name = $book->name;
$author = $book->author;
$price = $book->price;

if(isset($book->picture)){
    $picture = $book->picture;
}
else{
    $picture = '';
}


$arrayBookData = ['id'=>$id, 'bookname'=>$name, 'author'=>$author, 'picture'=>$picture, 'price'=>$price];
$addBookQuery = $pdo->prepare("INSERT INTO books VALUES (:id, :bookname, :author, :picture, :price)");
$addBookQuery->execute($arrayBookData);

$resp = (object) array('id' => $id);
echo json_encode($resp);