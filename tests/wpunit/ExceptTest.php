<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class ExceptTest extends ArraysTestCase {

	public function except_data_provider() {
		return [
			'empty_array' => [
				'array' => [],
				'keys' => ['foo'],
				'expected' => []
			],
			'empty_keys' => [
				'array' => ['foo' => 'bar', 'baz' => 'qux'],
				'keys' => [],
				'expected' => ['foo' => 'bar', 'baz' => 'qux']
			],
			'single_key' => [
				'array' => [
					'foo' => 'bar',
					'baz' => 'qux',
					'test' => 'value'
				],
				'keys' => ['foo'],
				'expected' => [
					'baz' => 'qux',
					'test' => 'value'
				]
			],
			'multiple_keys' => [
				'array' => [
					'foo' => 'bar',
					'baz' => 'qux',
					'test' => 'value',
					'key' => 'val'
				],
				'keys' => ['foo', 'test'],
				'expected' => [
					'baz' => 'qux',
					'key' => 'val'
				]
			],
			'non_existent_keys' => [
				'array' => [
					'foo' => 'bar',
					'baz' => 'qux'
				],
				'keys' => ['missing', 'nothere'],
				'expected' => [
					'foo' => 'bar',
					'baz' => 'qux'
				]
			],
			'mixed_existing_and_non_existing' => [
				'array' => [
					'foo' => 'bar',
					'baz' => 'qux',
					'test' => 'value'
				],
				'keys' => ['foo', 'missing', 'test'],
				'expected' => [
					'baz' => 'qux'
				]
			],
			'numeric_keys' => [
				'array' => [
					0 => 'zero',
					1 => 'one',
					'foo' => 'bar'
				],
				'keys' => [0, 'foo'],
				'expected' => [
					1 => 'one'
				]
			],
			'nested_arrays' => [
				'array' => [
					'foo' => 'bar',
					'nested' => [
						'inner' => 'value',
						'other' => 'val'
					],
					'baz' => 'qux'
				],
				'keys' => ['nested'],
				'expected' => [
					'foo' => 'bar',
					'baz' => 'qux'
				]
			],
			'nested_arrays_in_dot_notation' => [
				'array' => [
					'foo' => 'bar',
					'nested' => [
						'inner' => 'value',
						'other' => 'val'
					],
					'baz' => 'qux'
				],
				'keys' => 'nested.inner',
				'expected' => [
					'foo' => 'bar',
					'baz' => 'qux',
					'nested' => [
						'other' => 'val',
					],
				]
			],
		];
	}

	/**
	 * @dataProvider except_data_provider
	 */
	public function test_except($array, $keys, $expected) {
		$original = $array;
		$this->assertEquals($expected, Arr::except($array, $keys));
		$this->assertEquals($original, $array);
	}
}
