<?php
extract($_POST);

$rate = $homeloaninterest / 12 / 100;
$n = $homeloanterm * 12;

$emi = $homeprice * $rate * pow((1 + $rate), $n) / (pow((1 + $rate), $n) - 1);

$final = array();
$final['emi'] = round($emi);
$final['details'] = array();

for ($i = 0; $i < $n; $i++) {
    $temp = array();
    $b = $homeprice * $rate;
    $a = $emi - $b;
    $temp['balance'] = round($homeprice - $emi + $b);
    $temp['a'] = round($a);
    $temp['b'] = round($b);
    $temp['c'] = 0;

    array_push($final['details'], $temp);

    $homeprice -= $a;
}

echo json_encode($final);