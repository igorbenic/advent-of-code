<?php
/**
 * Day 1: https://adventofcode.com/2024/day/3
 *
 */


$input = file_get_contents("inputs/day3.txt");

function mul($x,$y) {
	return $x*$y;
}

$regex = "/mul\(\d{1,3},\d{1,3}\)/";

preg_match_all($regex, $input, $matches);

$sum = 0;
foreach ( $matches[0] as $func ) {
	$sum += eval('return ' . $func .';');
}

echo "Part 1: " . $sum;

while( false !== strpos( $input,"don't()" )) {
	$index = strpos( $input,"don't()");
	$indexDo = strpos( $input,"do()" );


		while ( $indexDo !== false && $indexDo < $index) {
			$indexDo = strpos( $input,"do()", $indexDo + 4 );
		}


	$length = $indexDo && $indexDo > $index ? $indexDo - $index + 4 : null;

	$string = substr( $input, $index, $length );

	$input = str_replace( $string, '', $input );

}

preg_match_all($regex, $input, $matches);

$sum = 0;
foreach ( $matches[0] as $func ) {
	$sum += eval('return ' . $func .';');
}
echo "\nPart 2: " . $sum;
