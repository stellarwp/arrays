<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class IsListTest extends ArraysTestCase {
	public function is_list_data_provider() {
		return [
			'empty_array' => [
				'array' => [],
				'expected' => true,
			],
			'sequential_numeric_keys' => [
				'array' => [0 => 'a', 1 => 'b', 2 => 'c'],
				'expected' => true,
			],
			'sequential_implicit_keys' => [
				'array' => ['a', 'b', 'c'],
				'expected' => true,
			],
			'non_sequential_numeric_keys' => [
				'array' => [0 => 'a', 2 => 'b', 3 => 'c'],
				'expected' => false,
			],
			'non_zero_starting_index' => [
				'array' => [1 => 'a', 2 => 'b', 3 => 'c'],
				'expected' => false,
			],
			'string_keys' => [
				'array' => ['foo' => 'a', 'bar' => 'b'],
				'expected' => false,
			],
			'mixed_keys' => [
				'array' => [0 => 'a', 'foo' => 'b', 2 => 'c'],
				'expected' => false,
			],
			'negative_index' => [
				'array' => [-1 => 'a', 0 => 'b', 1 => 'c'],
				'expected' => false,
			],
			'single_element_zero_index' => [
				'array' => [0 => 'a'],
				'expected' => true,
			],
			'single_element_non_zero_index' => [
				'array' => [1 => 'a'],
				'expected' => false,
			],
			'reindexed_array' => [
				'array' => array_values(['foo' => 'a', 'bar' => 'b']),
				'expected' => true,
			],
			'nested_arrays' => [
				'array' => [['a', 'b'], ['c', 'd']],
				'expected' => true,
			],
			'nested_arrays_with_gaps' => [
				'array' => [0 => ['a', 'b'], 2 => ['c', 'd']],
				'expected' => false,
			],
		];
	}

	/**
	 * @dataProvider is_list_data_provider
	 */
	public function test_is_list(array $array, bool $expected) {
		$this->assertSame($expected, Arr::is_list($array));
	}
}
