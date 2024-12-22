<?php
/**
 * Day 1: https://adventofcode.com/2024/day/2
 *
 */

$input = file("inputs/day6.txt", FILE_IGNORE_NEW_LINES);

class Guardian {
	protected $map = [];

	protected $position = null;

	protected $count = 0;

	protected $exit = false;

	protected $direction = 'up';

	public function __construct( $map ) {
		$this->map = $map;
	}

	public function getCount() {
		return $this->count;
	}

	public function setNextDirection() {
		switch ( $this->direction ) {
			case 'up':
				$this->direction = 'right';
				break;
			case 'right':
				$this->direction = 'down';
				break;
			case 'down':
				$this->direction = 'left';
				break;
			default:
				$this->direction = 'up';
		}

		return $this->direction;
	}

	public function findPosition() {
		foreach ( $this->map as $index => $mapLine ) {
			$pos = strpos( $mapLine, '^' );
			if ( false !== strpos( $mapLine, '^' ) ) {
				$this->position = [ $index, $pos ];
				$this->markMap( $index, $pos );
				return $this->position;
			}
		}
	}

	public function getPosition() {
		if ( null === $this->position ) {
			$this->findPosition();
		}

		return $this->position;
	}

	public function getNextPosition() {
		$position = $this->getPosition();

		switch ( $this->direction ) {
			case 'up':
				$position[0] = $position[0] - 1;
				break;
			case 'down':
				$position[0] = $position[0] + 1;
				break;
			case 'left':
				$position[1] = $position[1] - 1;
				break;
			case 'right':
				$position[1] = $position[1] + 1;
				break;
		}

		return $position;

	}

	public function isExit( $position ) {
		if ( $position[0] < 0 || $position[0] >= count( $this->map ) ) {
			return true;
		}

		if ( $position[1] < 0 || $position[1] >= strlen( $this->map[0] ) ) {
			return true;
		}

		return false;
	}

	public function move() {
		$position = $this->getNextPosition();

		if ( $this->isExit( $position ) ) {
			$this->exit = true;
			return;
		}
 
		if ( $this->isObstacle( $position ) ) {
			$this->setNextDirection();
			echo "\n";
			return;
		}

		$this->markMap( $position[0], $position[1] );
		$this->position = $position;
	}

	public function markMap( $index, $col ) {
		$this->map[ $index ][ $col ] = 'X';
	}

	public function isObstacle( $position ) {
		$index = $position[0];
		$col   = $position[1];

		return '#' === $this->map[$index][$col];
	}

	public function countX() {
		foreach ( $this->map as $index => $mapLine ) {
			$count = substr_count( $mapLine, 'X' );
			$this->count += $count;
		}
	}

	public function run() {
		while( !$this->exit ) {
			$this->move();
		}
	}
}

$guardian = new Guardian( $input );
$guardian->run();
$guardian->countX();
echo "Moves: " . $guardian->getCount() . "\n";