<?php
session_start();
require './config.php';
require './connect.php';

$orderData = json_decode(file_get_contents('php://input'));

$orderDataArr = ['userId'=>$orderData->userId, 'bookId'=>$orderData->bookId];
$orderQuery = $pdo->prepare('INSERT INTO orders (userId, bookId)VALUES (:userId, :bookId)');
$orderQuery->execute($orderDataArr);