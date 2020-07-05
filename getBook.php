<?php
require './config.php';
require './connect.php';

$bookId = $_GET['bookId'];

$arrQuery =['bookId'=>$bookId];
$booksQuery = $pdo->prepare("SELECT * FROM books WHERE id=:bookId");
$booksQuery->execute($arrQuery);

$bookName= $booksQuery->fetch(PDO::FETCH_ASSOC);

echo json_encode($bookName); 