<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class GetInAnyTest extends ArraysTestCase {

	public function get_in_any_data_provider() {
		return [
			'empty_array' => [
				'variables' => [],
				'indexes' => 'test',
				'default' => 'default',
				'expected' => 'default',
			],
			'simple_key_first_array' => [
				'variables' => [
					[ 'key' => 'value1' ],
					[ 'key' => 'value2' ],
				],
				'indexes' => 'key',
				'default' => null,
				'expected' => 'value1',
			],
			'simple_key_second_array' => [
				'variables' => [
					[ 'other' => 'value1' ],
					[ 'key' => 'value2' ],
				],
				'indexes' => 'key',
				'default' => null,
				'expected' => 'value2',
			],
			'nested_key_first_array' => [
				'variables' => [
					[ 'level1' => [ 'level2' => 'found' ] ],
					[ 'level1' => [ 'level2' => 'not this' ] ],
				],
				'indexes' => [ 'level1', 'level2' ],
				'default' => null,
				'expected' => 'found',
			],
			'nested_key_second_array' => [
				'variables' => [
					[ 'level1' => [ 'wrong' => 'value' ] ],
					[ 'level1' => [ 'level2' => 'found' ] ],
				],
				'indexes' => [ 'level1', 'level2' ],
				'default' => null,
				'expected' => 'found',
			],
			'not_found_returns_default' => [
				'variables' => [
					[ 'key1' => 'value1' ],
					[ 'key2' => 'value2' ],
				],
				'indexes' => 'missing',
				'default' => 'default_value',
				'expected' => 'default_value',
			],
			'dot_notation' => [
				'variables' => [
					[ 'level1' => [ 'wrong' => 'value' ] ],
					[ 'level1' => [ 'level2' => 'found' ] ],
				],
				'indexes' => 'level1.level2',
				'default' => null,
				'expected' => 'found',
			],
			'deep_nested' => [
				'variables' => [
					[
						'level1' => [
							'level2' => [
								'level3' => [
									'level4' => 'deep_value',
								],
							],
						],
					],
					[ 'simple' => 'value' ],
				],
				'indexes' => [ 'level1', 'level2', 'level3', 'level4' ],
				'default' => null,
				'expected' => 'deep_value',
			],
			'mixed_types' => [
				'variables' => [
					[ 'key' => 123 ],
					[ 'key' => 'string' ],
				],
				'indexes' => 'key',
				'default' => null,
				'expected' => 123,
			],
			'array_value' => [
				'variables' => [
					[ 'key' => [ 1, 2, 3 ] ],
					[ 'key' => 'value' ],
				],
				'indexes' => 'key',
				'default' => null,
				'expected' => [ 1, 2, 3 ],
			],
		];
	}

	/**
	 * @dataProvider get_in_any_data_provider
	 */
	public function test_get_in_any( $variables, $indexes, $default, $expected ) {
		$this->assertSame( $expected, Arr::get_in_any( $variables, $indexes, $default ) );
	}
}
