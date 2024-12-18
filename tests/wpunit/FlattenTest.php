<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class FlattenTest extends ArraysTestCase {
	public function flatten_data_provider() {
		return [
			'empty_array' => [
				'array' => [],
				'depth' => PHP_INT_MAX,
				'expected' => [],
			],
			'already_flat_array' => [
				'array' => [ 'a', 'b', 'c' ],
				'depth' => PHP_INT_MAX,
				'expected' => [ 'a', 'b', 'c' ],
			],
			'single_level_nested' => [
				'array' => [ 'a', [ 'b', 'c' ], 'd' ],
				'depth' => PHP_INT_MAX,
				'expected' => [ 'a', 'b', 'c', 'd' ],
			],
			'multiple_level_nested' => [
				'array' => [ 'a', [ 'b', [ 'c', 'd' ] ], 'e' ],
				'depth' => PHP_INT_MAX,
				'expected' => [ 'a', 'b', 'c', 'd', 'e' ],
			],
			'depth_1' => [
				'array' => [ 'a', [ 'b', [ 'c', 'd' ] ], 'e' ],
				'depth' => 1,
				'expected' => [ 'a', 'b', [ 'c', 'd' ], 'e' ],
			],
			'depth_2' => [
				'array' => [ 'a', [ 'b', [ 'c', [ 'd' ] ] ], 'e' ],
				'depth' => 2,
				'expected' => [ 'a', 'b', 'c', [ 'd' ], 'e' ],
			],
			'associative_array' => [
				'array' => [
					'a' => 1,
					'b' => [ 'c' => 2, 'd' => 3 ],
					'e' => 4,
				],
				'depth' => PHP_INT_MAX,
				'expected' => [ 'a' => 1, 'c' => 2, 'd' => 3, 'e' => 4 ],
			],
			'mixed_values' => [
				'array' => [
					'a',
					[ 'b', 1, [ 'c', 2 ] ],
					3,
					[ true, [ false, null ] ],
				],
				'depth' => PHP_INT_MAX,
				'expected' => [ 'a', 'b', 1, 'c', 2, 3, true, false, null ],
			],
			'empty_arrays' => [
				'array' => [ 'a', [], [ 'b', [], 'c' ], [] ],
				'depth' => PHP_INT_MAX,
				'expected' => [ 'a', 'b', 'c' ],
			],
			'zero_depth' => [
				'array' => [ 'a', [ 'b', [ 'c' ] ] ],
				'depth' => 0,
				'expected' => [ 'a', [ 'b', [ 'c' ] ] ],
			],
			'negative_depth' => [
				'array' => [ 'a', [ 'b', [ 'c' ] ] ],
				'depth' => -1,
				'expected' => [ 'a', [ 'b', [ 'c' ] ] ],
			],
			'deep_nested' => [
				'array' => [
					'a',
					[
						'b',
						[
							'c',
							[
								'd',
								[
									'e',
									[ 'f' ],
								],
							],
						],
					],
				],
				'depth' => PHP_INT_MAX,
				'expected' => [ 'a', 'b', 'c', 'd', 'e', 'f' ],
			],
			'preserve_string_keys' => [
				'array' => [
					'key1' => 'a',
					'key2' => [ 'key3' => 'b', 'key4' => [ 'key5' => 'c' ] ],
				],
				'depth' => PHP_INT_MAX,
				'expected' => [ 'key1' => 'a', 'key3' => 'b', 'key5' => 'c' ],
			],
		];
	}

	/**
	 * @dataProvider flatten_data_provider
	 */
	public function test_flatten( $array, $depth, $expected ) {
		$this->assertSame( $expected, Arr::flatten( $array, $depth ) );
	}
}
