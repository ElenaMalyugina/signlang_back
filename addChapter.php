<?php
require './config.php';
require './connect.php';

$request_body = file_get_contents('php://input');
$chapter = json_decode($request_body);

$id = uniqid();
$name = $chapter->name;
$bookId = $chapter->bookId;

if(isset($chapter->cover)){
    $cover = $chapter->cover;
}
else{
    $cover = '';
}

$arrayChapterData = ['id'=>$id, 'chaptername'=>$name, 'cover'=>$cover, 'bookId'=>$bookId];
$addChapterQuery = $pdo->prepare("INSERT INTO chapters VALUES (:id, :chaptername, :cover, :bookId)");
$addChapterQuery->execute($arrayChapterData);

$resp = (object) array('id' => $id);
echo json_encode($resp);