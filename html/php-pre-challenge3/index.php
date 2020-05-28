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

intval($limit); //文字列をint型に変換

if ($limit < 1) {
    http_response_code(400);
}