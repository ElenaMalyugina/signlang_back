<?php
require './config.php';
require './connect.php';

$request_body = file_get_contents('php://input');
$comment = json_decode($request_body);

$commentId = uniqid();
$entityId= $comment->entityId;
$commentText = $comment->commentText;
$authorId = $comment->authorId;

$commentArr=['commentId'=>$commentId, 'entityId'=>$entityId, 'commentText'=> $commentText, 'authorId'=>$authorId];
$addCommentQuery = $pdo->prepare("INSERT INTO comments VALUES (:commentId, :entityId, :commentText, :authorId)");

$addCommentQuery->execute($commentArr);


