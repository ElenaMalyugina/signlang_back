<?php
require './config.php';
require './connect.php';

$request_body = file_get_contents('php://input');
$chapter = json_decode($request_body);

$id = $chapter->id;
$name = $chapter->name;
$bookId = $chapter->bookId;

if(isset($chapter->cover)){
    $cover = $chapter->cover;
}
else{
    $cover = '';
}

$arrayChapterData = ['id'=>$id, 'chaptername'=>$name];
$addChapterQuery = $pdo->prepare("UPDATE chapters SET `name`=:chaptername WHERE id=:id");
$addChapterQuery->execute($arrayChapterData);

$resp = (object) array('res' => 'успешно обновлено');
echo json_encode($resp);