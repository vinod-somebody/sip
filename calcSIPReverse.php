<?php
extract($_POST);

$returnRate2 = $interest / 100 / 12;
$months = $duration * 12;

$monthlyInvestment = round($amount / ((pow((1 + $returnRate2), $months) - 1) * ((1 + $returnRate2) / $returnRate2)));
$targetAmount = $amount;

$totalInvestment = $monthlyInvestment * $months;

echo json_encode(compact('targetAmount', 'monthlyInvestment', 'totalInvestment'));