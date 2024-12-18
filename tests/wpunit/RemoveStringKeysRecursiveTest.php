<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class RemoveStringKeysRecursiveTest extends ArraysTestCase {

	public function key_fitering_data_provider() {
		return [
			'empty array'                                  => [
				'input'                => [],
				'expected_numeric'     => [],
				'expected_associative' => []
			],
			'only implicit numeric keys array'             => [
				'input'                => [ 'foo', 'bar', [ 'baz_1', 'baz_2', [ 'lorem', 'dolor' ] ] ],
				'expected_numeric'     => [ 'foo', 'bar', [ 'baz_1', 'baz_2', [ 'lorem', 'dolor' ] ] ],
				'expected_associative' => [],
			],
			'mix of implicit numeric keys and string keys' => [
				'input'                => [
					'foo',
					'bar',
					[ 'baz_1', 'baz_2', [ 'lorem', 'dolor' ] ],
					'string_1' => [ 'string_1_1' => 23 ],
					[ 'string_2' => 89, 'lorem' ]
				],
				'expected_numeric'     => [ 'foo', 'bar', [ 'baz_1', 'baz_2', [ 'lorem', 'dolor' ] ], [ 'lorem' ] ],
				'expected_associative' => [ 'string_1' => [ 'string_1_1' => 23 ] ],
			],
			'explicit numeric keys only'                   => [
				'input'                => [ 23 => 'foo', 89 => 'bar', 121 => [ 1 => 'baz_1', 2 => 'baz_2', 142 => [ 3 => 'lorem', 4 => 'dolor' ] ] ],
				'expected_numeric'     => [ 23 => 'foo', 89 => 'bar', 121 => [ 1 => 'baz_1', 2 => 'baz_2', 142 => [ 3 => 'lorem', 4 => 'dolor' ] ] ],
				'expected_associative' => [],
			],
			'mix of explicit numeric keys and string keys' => [
				'input'                => [
					1          => 'foo',
					2          => 'bar',
					3          => [ 11 => 'baz_1', 12 => 'baz_2', 13 => [ 14 => 'lorem', 15 => 'dolor' ] ],
					'string_1' => [ 'string_1_1' => 23 ],
					4          => [ 'string_2' => 89, 17 => 'lorem' ]
				],
				'expected_numeric'     => [
					1 => 'foo',
					2 => 'bar',
					3 => [ 11 => 'baz_1', 12 => 'baz_2', 13 => [ 14 => 'lorem', 15 => 'dolor' ] ],
					4 => [ 17 => 'lorem' ]
				],
				'expected_associative' => [ 'string_1' => [ 'string_1_1' => 23 ] ],
			],
			'string arrays only'                           => [
				'input'                => [
					'string_1' => 'lorem',
					'string_2' => [ 'string_2_1' => 'lorem', 'string_2_2' => [ 'string_2_2_1' => 'lorem', 'string_2_2_2' => 'dolor' ] ]
				],
				'expected_numeric'     => [],
				'expected_associative' => [
					'string_1' => 'lorem',
					'string_2' => [
						'string_2_1' => 'lorem',
						'string_2_2' => [ 'string_2_2_1' => 'lorem', 'string_2_2_2' => 'dolor' ]
					]
				],
			],
		];
	}

	/**
	 * @dataProvider key_fitering_data_provider
	 */
	public function test_key_filtering( $input, $expected_numeric,$expected_associative ) {
		$this->assertEquals( $expected_numeric, Arr::remove_string_keys_recursive( $input ) );
		$this->assertEquals( $expected_associative, Arr::remove_numeric_keys_recursive( $input ) );
	}
}
