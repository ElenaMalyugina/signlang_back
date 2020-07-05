<?php
require './config.php';
require './connect.php';

$request_body = file_get_contents('php://input');
$lessonPart = json_decode($request_body);

$id = $lessonPart->id;
$chapterId = $lessonPart->chapterId;
$content = $lessonPart->content;
$stepNumber = $lessonPart->stepNumber;

$arrayChapterData = ['id'=>$id, 'content'=>$content, 'stepNumber'=>$stepNumber];
$editChapterQuery = $pdo->prepare("UPDATE chapterparts SET content = :content, stepNumber = :stepNumber WHERE id=:id");
$editChapterQuery->execute($arrayChapterData);

$resp = (object) array('res' => 'обновлено');
echo json_encode($resp);