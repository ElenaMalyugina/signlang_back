<?php
require './config.php';
require './connect.php';

$chapterId = $_GET['chapterId'];

$arrQuery = ['chapterId'=>$chapterId];

$booksQuery = $pdo->prepare("SELECT * FROM chapterparts WHERE chapterId=:chapterId ORDER BY stepNumber");
$booksQuery->execute($arrQuery);

$books= $booksQuery->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($books); 