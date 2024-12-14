<?php
/**
 * Day 1: https://adventofcode.com/2024/day/4
 *
 */

$inputs = file("inputs/day4.txt", FILE_IGNORE_NEW_LINES);

$found = 0;
$foundX = 0;

$maxRow = count($inputs);
foreach ($inputs as $row => $string) {
	$length = strlen($string);
    $canFindUp = $row >= 3;
	$canFindDown = $row < ( $maxRow - 3 );

	for( $s = 0; $s < $length; $s++) {
        $canFindLeft = $s >= 3;
		$canFindRight = $s < ( $length - 3 );
		$canFindDiagonalUpLeft = $canFindLeft && $canFindUp;
		$canFindDiagonalUpRight = $canFindRight && $canFindUp;
		$canFindDiagonalDownLeft = $canFindLeft && $canFindDown;
		$canFindDiagonalDownRight = $canFindRight && $canFindDown;

		// Using only X as starting point.
		if ( $string[ $s ] !== 'X' ) {
			continue;
		}

		if ( $canFindUp ) {
			$xmasString = $string[ $s ] . $inputs[ $row - 1 ][ $s ]  . $inputs[ $row - 2 ][ $s ]  . $inputs[ $row - 3 ][ $s ];
			if ( $xmasString === 'XMAS' ) {
				$found++;
			}
		}

		if ( $canFindDown ) {
			$xmasString = $string[ $s ] . $inputs[ $row + 1 ][ $s ]  . $inputs[ $row + 2 ][ $s ]  . $inputs[ $row + 3 ][ $s ];
			if ( $xmasString === 'XMAS' ) {
				$found++;
			}
		}

		if ( $canFindRight ) {
			$xmasString = $string[ $s ] . $string[ $s + 1 ] . $string[ $s + 2 ] . $string[ $s + 3 ];
			if ( $xmasString === 'XMAS' ) {
				$found++;
			}
		}

		if ( $canFindLeft ) {
			$xmasString = $string[ $s ] . $string[ $s - 1 ] . $string[ $s - 2 ] . $string[ $s - 3 ];
			if ( $xmasString === 'XMAS' ) {
				$found++;
			}
		}

		if ( $canFindDiagonalUpLeft ) {
			$xmasString = $string[ $s ] . $inputs[ $row - 1 ][ $s - 1]  . $inputs[ $row - 2 ][ $s - 2 ]  . $inputs[ $row - 3 ][ $s - 3 ];
			if ( $xmasString === 'XMAS' ) {
				$found++;
			}
		}

		if ( $canFindDiagonalUpRight) {
			$xmasString = $string[ $s ] . $inputs[ $row - 1 ][ $s + 1 ]  . $inputs[ $row - 2 ][ $s + 2 ]  . $inputs[ $row - 3 ][ $s + 3 ];
			if ( $xmasString === 'XMAS' ) {
				$found++;
			}
		}

		if ( $canFindDiagonalDownLeft ) {
			$xmasString = $string[ $s ] . $inputs[ $row + 1 ][ $s - 1]  . $inputs[ $row + 2 ][ $s - 2 ]  . $inputs[ $row + 3 ][ $s - 3 ];
			if ( $xmasString === 'XMAS' ) {
				$found++;
			}
		}

		if ( $canFindDiagonalDownRight) {
			$xmasString = $string[ $s ] . $inputs[ $row + 1 ][ $s + 1 ]  . $inputs[ $row + 2 ][ $s + 2 ]  . $inputs[ $row + 3 ][ $s + 3 ];
			if ( $xmasString === 'XMAS' ) {
				$found++;
			}
		}
	}
}

echo "Part 1 - Found XMAS: " . $found;

foreach ($inputs as $row => $string) {
	$length = strlen($string);
	$canFindUp = $row >= 1;
	$canFindDown = $row < ( $maxRow - 1 );

	for( $s = 0; $s < $length; $s++) {
		$canFindLeft = $s >= 1;
		$canFindRight = $s < ( $length - 1 );
		$canFindDiagonalUpLeft = $canFindLeft && $canFindUp;
		$canFindDiagonalUpRight = $canFindRight && $canFindUp;
		$canFindDiagonalDownLeft = $canFindLeft && $canFindDown;
		$canFindDiagonalDownRight = $canFindRight && $canFindDown;

		// Using only A as starting point.
		if ( $string[ $s ] !== 'A' ) {
			continue;
		}

		$foundDiagonalA = false;
		$foundDiagonalB = false;

		if ( $canFindDiagonalDownLeft && $canFindDiagonalUpRight ) {
            if ( 'S' === $inputs[ $row - 1 ][ $s + 1 ] && 'M' === $inputs[ $row + 1 ][ $s - 1 ] ) {
                $foundDiagonalA = true;
            }
			if ( 'M' === $inputs[ $row - 1 ][ $s + 1 ] && 'S' === $inputs[ $row + 1 ][ $s - 1 ] ) {
				$foundDiagonalA = true;
			}
		}

		if ( $canFindDiagonalUpLeft && $canFindDiagonalDownRight ) {
			if ( 'S' === $inputs[ $row - 1 ][ $s - 1 ] && 'M' === $inputs[ $row + 1 ][ $s + 1 ] ) {
				$foundDiagonalB = true;
			}
			if ( 'M' === $inputs[ $row - 1 ][ $s - 1 ] && 'S' === $inputs[ $row + 1 ][ $s + 1 ] ) {
				$foundDiagonalB = true;
			}
		}

		if ( $foundDiagonalA && $foundDiagonalB ) {
			$foundX++;
		}

	}
}
echo "\nPart 2 - Found X-MAS: " . $foundX;