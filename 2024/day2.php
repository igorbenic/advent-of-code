<?php
/**
 * Day 1: https://adventofcode.com/2024/day/2
 *
 */

$inputs = file("inputs/day2.txt", FILE_IGNORE_NEW_LINES);
$safeCount   = 0;
$unsafeReports = [];

foreach ($inputs as $input) {
	$report = explode( " ", $input );

	$safe = isReportSafe( $report );

	if ( $safe === true ) {
		$safeCount++;
	} else {
		$unsafeReports[] = $report;
	}

}

function isReportSafe( $report ) {
	$lastNumber = null;
	$direction  = null;

	for( $r = 0; $r < count($report); $r++ ) {
		$current = $report[$r];
		if ( $lastNumber === null ) {
			$lastNumber = $current;
			continue;
		}

		if ( $direction === null ) {
			if ( $lastNumber < $current ) {
				$direction = 1;
			} else {
				$direction = 0;
			}
		} else {
			if ( $direction === 0 && $lastNumber < $current ) {
				return false;
			}

			if ( $direction === 1 && $lastNumber > $current ) {
				return false;
			}
		}

		$diff = abs( $lastNumber - $current );
		if ( $diff < 1 || $diff > 3 ) {
			return false;
		}
		$lastNumber = $current;
	}

	return true;
}

echo "Part 1: Safe Reports: " . $safeCount . " / " . count($inputs) . "\n";

foreach ($unsafeReports as $orig_report ) {
$blocks = [];
	for( $r = 0; $r < count($orig_report); $r++ ) {
		$report_to_check = $orig_report;
		unset( $report_to_check[$r] );
		$report_to_check = array_values( $report_to_check );
		$blocks[] = $report_to_check;
		$safe = isReportSafe( $report_to_check );

		if ( $safe === true ) {
			$safeCount++;
			break;
		}

	}
}

echo "Part 2: Safe Reports: " . $safeCount . " / " . count($inputs) . "\n";
