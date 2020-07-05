<?php
require './config.php';
require './connect.php';

$request_body = file_get_contents('php://input');
$book = json_decode($request_body);

$id = $book->id;
$name = $book->name;
$author = $book->author;
$price = $book->price;

if(isset($book->picture)){
    $picture = $book->picture;
}
else{
    $picture = '';
}


$arrayBookData = ['id'=>$id, 'bookname'=>$name, 'author'=>$author, 'price'=>$price];
$addBookQuery = $pdo->prepare("UPDATE books SET `name`= :bookname, author = :author, price = :price WHERE id = :id");
$addBookQuery->execute($arrayBookData);

$resp = (object) array('res' => 'Запись обновлена');
echo json_encode($resp);