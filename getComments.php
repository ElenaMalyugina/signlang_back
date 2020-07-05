<?php
require './config.php';
require './connect.php';

$entityId = $_GET['entityId'];

$arrQuery =['entityId'=>$entityId];
$commentsQuery = $pdo->prepare("SELECT `commentId`, `entityId`, `commentText`, `authorId`, `login`, `photo` FROM comments LEFT JOIN users ON comments.authorId=users.userId WHERE entityId=:entityId");
$commentsQuery->execute($arrQuery);

$comments= $commentsQuery->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($comments); 