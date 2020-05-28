<?php
$limit = $_GET['target'];

$dsn = 'mysql:dbname=test;host=mysql';
$dbuser = 'test';
$dbpassword = 'test';

try {
    $db = new PDO($dbn, $dbuser, $dbpassword);
} catch (PDOException $e) {
    echo 'DB接続エラー：';  $e->getMessage();
    http_response_code(500);
}

