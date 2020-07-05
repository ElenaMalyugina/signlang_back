<?php
require './config.php';
require './connect.php';

$request_body = file_get_contents('php://input');
$lessonPart = json_decode($request_body);

$id = uniqid();
$chapterId = $lessonPart->chapterId;
$content = $lessonPart->content;
$stepNumber = $lessonPart->stepNumber;

$arrayChapterData = ['id'=>$id, 'chapterId'=>$chapterId, 'content'=>$content, 'stepNumber'=>$stepNumber];
$addChapterQuery = $pdo->prepare("INSERT INTO chapterparts VALUES (:id, :chapterId, :content, :stepNumber)");
$addChapterQuery->execute($arrayChapterData);

$resp = (object) array('id' => $id);
echo json_encode($resp);