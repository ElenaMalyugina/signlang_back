<?php
require './config.php';
require './connect.php';

$booksQuery = $pdo->prepare("SELECT * FROM books");
$booksQuery->execute();

$books = $booksQuery->fetchAll(PDO::FETCH_ASSOC);

$userId = $_GET['userId'];
$boughtBookArr = ['userId'=>$userId];
$boughtBookQuery = $pdo->prepare("SELECT * FROM orders WHERE userId = :userId");
$boughtBookQuery->execute($boughtBookArr);
$boughtBooks = $boughtBookQuery->fetchAll(PDO::FETCH_ASSOC);

foreach($books as &$book) {
    foreach($boughtBooks as $boughtBook) {
        if(!isset($book['isBought'])){
            $book['isBought'] = false;
        }

        if($book['id'] === $boughtBook['bookId']) {
            $book['isBought'] = true;
        }
    }
}

unset($book);

echo json_encode($books); 