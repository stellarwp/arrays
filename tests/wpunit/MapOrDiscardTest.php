<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class MapOrDiscardTest extends ArraysTestCase {

	public function map_or_discard_inputs() {
		return [
			'all-mapped'              => [
				[ 'a', 'b', 'c' ],
				[ 'a' => 'foo', 'b' => 'baz', 'c' => 'bar' ],
				[ 'foo', 'baz', 'bar' ],
				true
			],
			'some-mapped'             => [ [ 'a', 'b', 'c' ], [ 'a' => 'foo', 'b' => 'baz' ], [ 'foo', 'baz' ], true ],
			'one-mapped'              => [ [ 'a', 'b', 'c' ], [ 'a' => 'foo' ], [ 'foo' ], true ],
			'one-key-mapped'          => [ 'a', [ 'a' => 'foo', 'b' => 'baz' ], 'foo', true ],
			'one-key-not-mapped'      => [ 'd', [ 'a' => 'foo', 'b' => 'baz' ], false, false ],
			'one-key-mapped-to-false' => [ 'a', [ 'a' => false, 'b' => 'baz' ], false, true ],
		];
	}

	/**
	 * Test map_or_discard
	 *
	 * @dataProvider map_or_discard_inputs
	 */
	public function test_map_or_discard( $input, $map, $expected, $expected_found ) {
		$found = false;
		$this->assertEquals( $expected, Arr::map_or_discard( $input, $map, $found ) );
		$this->assertEquals( $expected_found, $found );
	}
}
