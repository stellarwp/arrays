<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class IsAssocTest extends ArraysTestCase {
	public function is_assoc_data_provider() {
		return [
			'empty_array' => [
				'array' => [],
				'expected' => false,
			],
			'sequential_numeric_keys' => [
				'array' => [1, 2, 3, 4, 5],
				'expected' => false,
			],
			'sequential_string_values' => [
				'array' => ['a', 'b', 'c'],
				'expected' => false,
			],
			'string_keys' => [
				'array' => ['foo' => 'bar', 'baz' => 'qux'],
				'expected' => true,
			],
			'mixed_keys' => [
				'array' => [0 => 'foo', 'bar' => 'baz'],
				'expected' => true,
			],
			'non_sequential_numeric_keys' => [
				'array' => [1 => 'foo', 3 => 'bar', 5 => 'baz'],
				'expected' => true,
			],
			'zero_based_gaps' => [
				'array' => [0 => 'foo', 2 => 'bar', 3 => 'baz'],
				'expected' => true,
			],
			'single_numeric_key' => [
				'array' => [0 => 'foo'],
				'expected' => false,
			],
			'single_string_key' => [
				'array' => ['foo' => 'bar'],
				'expected' => true,
			],
			'sequential_with_string_keys' => [
				'array' => [0 => 'foo', 1 => 'bar', 'key' => 'value'],
				'expected' => true,
			],
			'sequential_reindexed' => [
				'array' => array_values(['foo' => 'bar', 'baz' => 'qux']),
				'expected' => false,
			],
		];
	}

	/**
	 * @dataProvider is_assoc_data_provider
	 */
	public function test_is_assoc(array $array, bool $expected) {
		$this->assertSame($expected, Arr::is_assoc($array));
	}
}
