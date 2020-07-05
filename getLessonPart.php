<?php
require './config.php';
require './connect.php';

$id = $_GET['id'];

$arrQuery = ['id'=>$id];

$lessonPartQuery = $pdo->prepare("SELECT * FROM chapterparts WHERE id=:id");
$lessonPartQuery->execute($arrQuery);

$lessonPart= $lessonPartQuery->fetch(PDO::FETCH_ASSOC);

echo json_encode($lessonPart); 