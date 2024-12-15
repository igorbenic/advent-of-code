<?php
/**
 * https://adventofcode.com/2024/day/5
 *
 */


$input = file_get_contents('inputs/day5.txt');

$inputs = explode("\n\n", $input);

$orderRules = explode("\n", $inputs[0]);
$orderRulesFormatted = [];

foreach ( $orderRules as $orderRule ) {
	$rule = explode("|", $orderRule);

	if ( empty( $orderRulesFormatted[ $rule[0] ] ) ) {
		$orderRulesFormatted[ $rule[0] ] = [];
	}

	$orderRulesFormatted[ $rule[0] ][] = $rule[1];
}

$orders = explode("\n", $inputs[1]);

$safeOrderNumbers = [];
$incorrectOrders = [];
foreach ( $orders as $order ) {
	$orderArr = explode(",", $order);

	for( $o = 0; $o < count($orderArr); $o++ ) {

		if ( $o === 0 ) { continue;}

		$beforeArr = array_slice($orderArr, 0, $o );

		$ruleForNumber = $orderRulesFormatted[ $orderArr[$o] ];
		$found = array_intersect( $ruleForNumber, $beforeArr );

		if ( ! empty( $found ) ) {
			$incorrectOrders[] = $orderArr;
			continue 2;
		}

	}

	$count = count( $orderArr );
	$middle = floor($count / 2 );
	$safeOrderNumbers[] = $orderArr[$middle];
}

echo "Part 1: " . array_sum( $safeOrderNumbers ) . "\n";

echo count($incorrectOrders) . "\n";
$unsafeSum=[];

foreach( $incorrectOrders as $order ) {


	usort($order, function($a, $b) use ($orderRulesFormatted){
		$rule = $orderRulesFormatted[ $a ];
		if ( in_array( $b, $rule ) ) {
			return -1;
		}
		$rule = $orderRulesFormatted[ $b ];
		if ( in_array( $a, $rule ) ) {
			return 1;
		}

		return 0;
	});

	$count = count( $order );
	$middle = floor($count / 2 );
	$unsafeSum[] = $order[$middle];

}


echo "Part 2: " . array_sum( $unsafeSum ) . "\n";
