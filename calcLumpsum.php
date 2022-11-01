<?php
extract($_POST);

$amountExpected = $amount;

for ($i = 0; $i < $duration; $i++) {
    $amountExpected += $amountExpected * $interest / 100;
}
$amountExpected = round($amountExpected);
$wealthGained = round($amountExpected - $amount);

echo json_encode(compact('amountExpected', 'amount', 'wealthGained'));