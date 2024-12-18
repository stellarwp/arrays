<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class AddPrefixedKeysToTest extends ArraysTestCase {

	public function add_prefixed_keys_data_provider() {
		return [
			'non_array_input' => [
				'input' => 'string',
				'expected' => 'string'
			],
			'empty_array' => [
				'input' => [],
				'expected' => []
			],
			'simple_array' => [
				'input' => ['foo' => 'bar'],
				'expected' => [
					'foo' => 'bar',
					'_foo' => 'bar'
				]
			],
			'array_with_prefixed_key' => [
				'input' => ['_foo' => 'bar'],
				'expected' => ['_foo' => 'bar']
			],
			'nested_array_no_recursion' => [
				'input' => [
					'foo' => [
						'bar' => 'baz',
						'_existing' => 'value'
					]
				],
				'expected' => [
					'foo' => [
						'bar' => 'baz',
						'_existing' => 'value'
					],
					'_foo' => [
						'bar' => 'baz',
						'_existing' => 'value'
					]
				],
				'recursive' => false
			],
			'nested_array_with_recursion' => [
				'input' => [
					'foo' => [
						'bar' => 'baz',
						'_existing' => 'value'
					]
				],
				'expected' => [
					'foo' => [
						'bar' => 'baz',
						'_bar' => 'baz',
						'_existing' => 'value'
					],
					'_foo' => [
						'bar' => 'baz',
						'_bar' => 'baz',
						'_existing' => 'value'
					]
				],
				'recursive' => true
			],
			'multiple_keys' => [
				'input' => [
					'foo' => 'bar',
					'baz' => 'qux',
					'_existing' => 'value'
				],
				'expected' => [
					'foo' => 'bar',
					'_foo' => 'bar',
					'baz' => 'qux',
					'_baz' => 'qux',
					'_existing' => 'value'
				]
			],
			'deep_nested_with_recursion' => [
				'input' => [
					'level1' => [
						'level2' => [
							'level3' => 'value'
						]
					]
				],
				'expected' => [
					'level1' => [
						'level2' => [
							'level3' => 'value',
							'_level3' => 'value'
						],
						'_level2' => [
							'level3' => 'value',
							'_level3' => 'value'
						]
					],
					'_level1' => [
						'level2' => [
							'level3' => 'value',
							'_level3' => 'value'
						],
						'_level2' => [
							'level3' => 'value',
							'_level3' => 'value'
						]
					]
				],
				'recursive' => true
			]
		];
	}

	/**
	 * @dataProvider add_prefixed_keys_data_provider
	 */
	public function test_add_prefixed_keys_to($input, $expected, bool $recursive = false) {
		$this->assertEquals($expected, Arr::add_prefixed_keys_to($input, $recursive));
	}
}
