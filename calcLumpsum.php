<?php
extract($_POST);
// echo json_encode($_POST); exit;

// var p = 25000
// var r = 13
// var t = 20

// echo '<pre>';
// $amountInvested = 25000;
// $rate = 13;
// $time = 20;

$amountExpected = $amountInvested;

for ($i = 0; $i < $time; $i++) {
    $amountExpected += $amountExpected * $rate / 100;
}
$amountExpected = round($amountExpected);
$wealthGained = round($amountExpected - $amountInvested);
// console.log(Math.round(p))

echo json_encode(compact('amountExpected', 'amountInvested', 'wealthGained'));
// print_r(compact('amountExpected', 'amountInvested', 'wealthGained'));
// print_r(compact('amountExpected', 'amountInvested', 'wealthGained'));

// 10,000
// 11,000
// 12,100
// 13,310
// 14,641
// 16,105.1
// 17,716.61
// 19,488.271
// 21,437.0981
// 23,580.80791
// 25,938.888701