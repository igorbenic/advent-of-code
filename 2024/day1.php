<?php

/**
 * Day 1: https://adventofcode.com/2024/day/1
 *
 */

// Input string.
$inputs = "";

$string = str_replace("\n", " ", $inputs);
$string = str_replace("   ", " ", $string);
$array = array_filter(explode(" ", $string));
$arrayLeft = [];
$arrayRight = [];

foreach ($array as $index => $number) {
	if ($index % 2 === 0 || $index === 0) {
		$arrayLeft[] = $number;
	} else {
		$arrayRight[] = $number;
	}
}

sort($arrayLeft);
sort($arrayRight);

$distance = 0;
foreach ($arrayLeft as $index => $numberLeft) {
	$numberRight = $arrayRight[$index];
	$distance += abs($numberLeft - $numberRight);
}

echo "Distance: " . $distance;
echo "\n============== Part 2 =============\n";

$score = 0;

$arrayRightValues = array_count_values($arrayRight);

foreach ($arrayLeft as $numberLeft) {
	if (empty($arrayRightValues[$numberLeft])) {
		continue;
	}

	$score += $numberLeft * $arrayRightValues[$numberLeft];
}

echo "Similarity Score: " . $score;
