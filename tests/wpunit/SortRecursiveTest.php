<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class SortRecursiveTest extends ArraysTestCase {
	public function test_sort_recursive_simple_array() {
		$array = ['c', 'a', 'b'];
		$expected = ['a', 'b', 'c'];

		$result = Arr::sort_recursive($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_recursive_associative_array() {
		$array = [
			'colors' => ['red', 'blue', 'green'],
			'animals' => ['zebra', 'ant', 'cat']
		];

		$expected = [
			'animals' => ['ant', 'cat', 'zebra'],
			'colors' => ['blue', 'green', 'red']
		];

		$result = Arr::sort_recursive($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_recursive_nested_arrays() {
		$array = [
			'nested' => [
				'third' => ['c', 'a', 'b'],
				'first' => ['3', '1', '2'],
				'second' => ['z', 'x', 'y']
			],
			'top' => ['m', 'k', 'l']
		];

		$expected = [
			'nested' => [
				'first' => ['1', '2', '3'],
				'second' => ['x', 'y', 'z'],
				'third' => ['a', 'b', 'c']
			],
			'top' => ['k', 'l', 'm']
		];

		$result = Arr::sort_recursive($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_recursive_mixed_types() {
		$array = [
			'mixed' => [2, '1', 3, '10'],
			'strings' => ['10', '1', '2']
		];

		$expected = [
			'mixed' => ['1', 2, 3, '10'],
			'strings' => ['1', '2', '10']
		];

		$result = Arr::sort_recursive($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_recursive_empty_arrays() {
		$array = [
			'empty' => [],
			'nested' => [
				'also_empty' => [],
				'values' => ['b', 'a']
			]
		];

		$expected = [
			'empty' => [],
			'nested' => [
				'also_empty' => [],
				'values' => ['a', 'b']
			]
		];

		$result = Arr::sort_recursive($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_recursive_descending() {
		$array = [
			'numbers' => [1, 3, 2],
			'letters' => ['a', 'c', 'b']
		];

		$expected = [
			'numbers' => [3, 2, 1],
			'letters' => ['c', 'b', 'a']
		];

		$result = Arr::sort_recursive($array, SORT_REGULAR, true);

		$this->assertSame($expected, $result);
	}

	public function test_sort_recursive_with_sort_options() {
		$array = [
			'numbers' => ['10', '1', '2'],
			'mixed' => [2, '1', '10']
		];

		$expected = [
			'mixed' => ['1', '10', 2],
			'numbers' => ['1', '10', '2']
		];

		$result = Arr::sort_recursive($array, SORT_STRING);

		$this->assertSame($expected, $result);
	}
}
