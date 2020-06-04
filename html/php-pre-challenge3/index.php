<?php

$dsn = 'mysql:dbname=test;host=mysql';
$dbuser = 'test';
$dbpassword = 'test';

try {
    $db = new PDO($dsn, $dbuser, $dbpassword); //データベース接続
} catch (PDOException $e) {
    echo 'DB接続エラー：' . $e->getMessage();
    http_response_code(500);
}

$dbnumbers = $db->query('SELECT value FROM prechallenge3 ORDER BY value ASC'); //データベースへクエリ発行

$numbers = $dbnumbers->fetchAll(); //取得しデータを全てフェッチする

$numbers = array_column($numbers, 'value'); //特定のカラムを取り出す

$numbers = array_map('intval', $numbers);//配列の型を整数に変換

$limit = (int) $_GET['target']; //型を文字列から整数に変換

if ($limit < 1) {
    http_response_code(400);
}



$cnt = count($numbers);//for文の繰り返し条件の上限値を取得

$combinations = array();//配列の初期化

//全ての組み合わせを配列の要素に追加する
for ($i = 1; $i <= $cnt; $i++) {
    $temp = kumiawase($numbers, $i);
    $combinations = array_merge($combinations, $temp);
}


$answer = array();//配列の初期化

//条件に合致した配列要素を$answerに追加する
foreach ($combinations as $combination) {
    if (array_sum($combination) === $limit) {
        $answer[] = $combination;
    }
}


$json_data = json_encode($answer);//JSON形式にする



echo $json_data;//出力




//https://stabucky.com/wp/archives/2188 から引用
//組み合わせユーザー定義関数ついて比下さんに相談した上でそのまま使用しています。
function kumiawase($zentai, $nukitorisu)
{
    $zentaisu = count($zentai);
    if ($zentaisu < $nukitorisu) {
        return;
    } elseif ($nukitorisu == 1) {
        for ($i = 0; $i < $zentaisu; $i++) {
            $arrs[$i] = array($zentai[$i]);
        }
    } elseif ($nukitorisu > 1) {
        $j = 0;
        for ($i = 0; $i < $zentaisu - $nukitorisu + 1; $i++) {
            $ts = kumiawase(array_slice($zentai, $i + 1), $nukitorisu - 1);
            foreach ($ts as $t) {
                array_unshift($t, $zentai[$i]);
                $arrs[$j] = $t;
                $j++;
            }
        }
    }
    return $arrs;
}
