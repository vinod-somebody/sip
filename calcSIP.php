<?php
extract($_POST);

$totalInvestment = $amount * $duration * 12;

$returnRate = $interest / 100 / 12;
$months = $duration * 12;
$middleCalculation = pow((1 + $returnRate), $months) - 1;
$wealthGained = round($amount * $middleCalculation * ((1 + $returnRate) / $returnRate));
$maturityValue = $wealthGained - $totalInvestment;

echo json_encode(compact('totalInvestment', 'wealthGained', 'maturityValue'));