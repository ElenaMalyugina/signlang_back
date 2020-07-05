<?php
require './config.php';
require './connect.php';

$bookId = $_GET['bookId'];

$arrQuery =['bookId'=>$bookId];
$booksQuery = $pdo->prepare("SELECT * FROM chapters WHERE bookId=:bookId");
$booksQuery->execute($arrQuery);

$books= $booksQuery->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($books); 