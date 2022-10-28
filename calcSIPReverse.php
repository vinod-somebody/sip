<?php
extract($_POST);
// echo json_encode($_POST); exit;

$returnRate2 = $interest / 100 / 12;
$months = $years * 12;
$middleCalculation = pow((1 + $returnRate2), $months) - 1;
$resultGoalAmount = round($targetAmount / ($middleCalculation * ((1 + $returnRate2) / $returnRate2)));

$totalInvestment = $resultGoalAmount * $months;
// echo $totalInvestment; exit;

// 54500 = x * 0.26 * 101

echo json_encode(compact('resultGoalAmount', 'totalInvestment'));


// FV = PV(1+r)^n 
// FV = 50000 * pow((1 + 6.30), 3) 

// 10 / 100 / 12

// FV = Future Value 
// PV = Present Value 
// r = Rate of interest 
// n = Number of years

// For example, you have invested a lump sum amount of Rs 1,00,000 in a mutual fund scheme for 20 years. 
// You have the expected rate of return of 10% on the investment

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