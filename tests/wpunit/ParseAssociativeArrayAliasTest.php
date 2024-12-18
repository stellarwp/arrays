<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class ParseAssociativeArrayAliasTest extends ArraysTestCase {

	public function parse_associative_array_alias_data_sets() {
		$starter = [ 'card' => 'ace' ];

		return [
			// $original, $alias_map, $expected
			'empty'                 => [ [], [], [] ],
			'wo_alias'              => [ $starter, [], $starter ],
			'non_associative_alias' => [ $starter, [ 'ace' ], $starter ],
			'non_scalar_alias'      => [ $starter, [ [ 'ace' ] ], $starter ],
			'wo_canonical_conflict' => [
				$starter + [ 'player' => 'John' ],
				[ 'player' => 'name' ],
				$starter + [ 'name' => 'John' ],
			],
			'w_canonical_conflict'  => [
				$starter + [ 'player' => 'John', 'name' => 'Sally' ],
				[ 'player' => 'name' ],
				$starter + [ 'name' => 'Sally' ],
			],
		];
	}

	/**
	 * Test parse_associative_array_alias
	 * @dataProvider parse_associative_array_alias_data_sets
	 */
	public function test_parse_associative_array_alias( $original, $alias_map, $expected ) {
		$this->assertEquals( $expected, Arr::parse_associative_array_alias( $original, $alias_map ) );
	}
}
