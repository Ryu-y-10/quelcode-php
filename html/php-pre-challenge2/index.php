<?php
$array = explode(',', $_GET['array']);

// 修正はここから
$cnt = count($array);

for ($i = 0; $i < $cnt - 1; $i++) {
    for ($j = 0; $j < $cnt - 1 - $i; $j++) {
        if ($array[$j] > $array[$j + 1]) {
            $tmp = $array[$j + 1];
            $array[$j + 1] = $array[$j];
            $array[$j] = $tmp;
        }
    }
}
// 修正はここまで

echo "<pre>";
print_r($array);
echo "</pre>";
