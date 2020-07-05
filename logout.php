<?php
session_start();
require './setHeaders.php';

//echo json_encode($_SESSION);

if(isset($_SESSION)){
    session_destroy();
}