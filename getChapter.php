<?php
require './config.php';
require './connect.php';

$chapterId = $_GET['chapterId'];

$arrQuery =['id'=>$chapterId];
$chapterQuery = $pdo->prepare("SELECT * FROM chapters WHERE id=:id");
$chapterQuery->execute($arrQuery);

$chapter= $chapterQuery->fetch(PDO::FETCH_ASSOC);

echo json_encode($chapter); 