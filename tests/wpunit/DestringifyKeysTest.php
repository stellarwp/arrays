<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class DestringifyKeysTest extends ArraysTestCase {

	public function destringify_keys_data_provider() {
		return [
			'empty_array' => [
				'input' => [],
				'expected' => [],
				'prefix' => 'sk_'
			],
			'no_stringified_keys' => [
				'input' => [
					'foo' => 'bar',
					'baz' => 'qux'
				],
				'expected' => [
					'foo' => 'bar',
					'baz' => 'qux'
				],
				'prefix' => 'sk_'
			],
			'simple_stringified_keys' => [
				'input' => [
					'sk_0' => 'foo',
					'sk_1' => 'bar',
					'normal' => 'value'
				],
				'expected' => [
					0 => 'foo',
					1 => 'bar',
					'normal' => 'value'
				],
				'prefix' => 'sk_'
			],
			'custom_prefix' => [
				'input' => [
					'custom_0' => 'foo',
					'custom_1' => 'bar',
					'normal' => 'value'
				],
				'expected' => [
					0 => 'foo',
					1 => 'bar',
					'normal' => 'value'
				],
				'prefix' => 'custom_'
			],
			'nested_arrays' => [
				'input' => [
					'sk_0' => [
						'sk_0' => 'nested',
						'normal' => 'value'
					],
					'normal' => [
						'sk_0' => 'also_nested'
					]
				],
				'expected' => [
					0 => [
						0 => 'nested',
						'normal' => 'value'
					],
					'normal' => [
						0 => 'also_nested'
					]
				],
				'prefix' => 'sk_'
			],
			'mixed_keys' => [
				'input' => [
					'sk_0' => 'foo',
					'normal' => 'bar',
					'sk_1' => [
						'sk_0' => 'nested',
						'regular' => 'value'
					]
				],
				'expected' => [
					0 => 'foo',
					'normal' => 'bar',
					1 => [
						0 => 'nested',
						'regular' => 'value'
					]
				],
				'prefix' => 'sk_'
			],
			'non_numeric_stringified' => [
				'input' => [
					'sk_abc' => 'foo',
					'sk_def' => 'bar'
				],
				'expected' => [
					0 => 'foo',
					1 => 'bar'
				],
				'prefix' => 'sk_'
			],
			'deep_nested_structure' => [
				'input' => [
					'sk_0' => [
						'sk_0' => [
							'sk_0' => 'deep',
							'normal' => 'value'
						]
					]
				],
				'expected' => [
					0 => [
						0 => [
							0 => 'deep',
							'normal' => 'value'
						]
					]
				],
				'prefix' => 'sk_'
			]
		];
	}

	/**
	 * @dataProvider destringify_keys_data_provider
	 */
	public function test_destringify_keys($input, $expected, $prefix) {
		$this->assertEquals($expected, Arr::destringify_keys($input, $prefix));
	}
}
