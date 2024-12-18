<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class GetTest extends ArraysTestCase {
	public function get_data_provider() {
		return [
			'empty_array' => [
				'array' => [],
				'key' => 'test',
				'default' => 'default',
				'expected' => 'default',
			],
			'simple_key' => [
				'array' => [ 'key' => 'value' ],
				'key' => 'key',
				'default' => null,
				'expected' => 'value',
			],
			'missing_key' => [
				'array' => [ 'key' => 'value' ],
				'key' => 'missing',
				'default' => 'default_value',
				'expected' => 'default_value',
			],
			'dot_notation' => [
				'array' => [
					'level1' => [
						'level2' => 'nested_value',
					],
				],
				'key' => 'level1.level2',
				'default' => null,
				'expected' => 'nested_value',
			],
			'array_notation' => [
				'array' => [
					'level1' => [
						'level2' => 'nested_value',
					],
				],
				'key' => [ 'level1', 'level2' ],
				'default' => null,
				'expected' => 'nested_value',
			],
			'missing_nested_key' => [
				'array' => [
					'level1' => [
						'wrong' => 'value',
					],
				],
				'key' => 'level1.level2',
				'default' => 'default_value',
				'expected' => 'default_value',
			],
			'null_key' => [
				'array' => [ 'key' => 'value' ],
				'key' => null,
				'default' => null,
				'expected' => [ 'key' => 'value' ],
			],
			'object_conversion' => [
				'array' => (object) [ 'key' => 'value' ],
				'key' => 'key',
				'default' => null,
				'expected' => 'ERROR',
			],
			'numeric_key' => [
				'array' => [ 0 => 'zero', 1 => 'one' ],
				'key' => 0,
				'default' => null,
				'expected' => 'zero',
			],
			'deep_nested' => [
				'array' => [
					'a' => [
						'b' => [
							'c' => [
								'd' => 'found',
							],
						],
					],
				],
				'key' => [ 'a', 'b', 'c', 'd' ],
				'default' => null,
				'expected' => 'found',
			],
			'array_value' => [
				'array' => [
					'key' => [ 1, 2, 3 ],
				],
				'key' => 'key',
				'default' => null,
				'expected' => [ 1, 2, 3 ],
			],
			'non_array_input' => [
				'array' => 'not_an_array',
				'key' => 'any_key',
				'default' => 'default_value',
				'expected' => 'ERROR',
			],
		];
	}

	/**
	 * @dataProvider get_data_provider
	 */
	public function test_get( $array, $key, $default, $expected ) {
		if ( $expected === 'ERROR' ) {
			$this->expectException( \InvalidArgumentException::class );
		}

		$this->assertSame( $expected, Arr::get( $array, $key, $default ) );
	}
}
