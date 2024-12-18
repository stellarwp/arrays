<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class SortRecursiveDescTest extends ArraysTestCase {
	public function test_sort_recursive_desc_simple_array() {
		$array = ['a', 'c', 'b'];
		$expected = ['c', 'b', 'a'];

		$result = Arr::sort_recursive_desc($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_recursive_desc_associative_array() {
		$array = [
			'colors' => ['red', 'blue', 'green'],
			'animals' => ['zebra', 'ant', 'cat']
		];

		$expected = [
			'colors' => ['red', 'green', 'blue'],
			'animals' => ['zebra', 'cat', 'ant']
		];

		$result = Arr::sort_recursive_desc($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_recursive_desc_nested_arrays() {
		$array = [
			'nested' => [
				'third' => ['c', 'a', 'b'],
				'first' => ['3', '1', '2'],
				'second' => ['z', 'x', 'y']
			],
			'top' => ['m', 'k', 'l']
		];

		$expected = [
			'top' => ['m', 'l', 'k'],
			'nested' => [
				'third' => ['c', 'b', 'a'],
				'second' => ['z', 'y', 'x'],
				'first' => ['3', '2', '1']
			]
		];

		$result = Arr::sort_recursive_desc($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_recursive_desc_mixed_types() {
		$array = [
			'mixed' => [2, '1', 3, '10'],
			'strings' => ['10', '1', '2']
		];

		$expected = [
			'strings' => ['10', '2', '1'],
			'mixed' => ['10', 3, 2, '1']
		];

		$result = Arr::sort_recursive_desc($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_recursive_desc_empty_arrays() {
		$array = [
			'empty' => [],
			'nested' => [
				'also_empty' => [],
				'values' => ['b', 'a']
			]
		];

		$expected = [
			'nested' => [
				'values' => ['b', 'a'],
				'also_empty' => []
			],
			'empty' => []
		];

		$result = Arr::sort_recursive_desc($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_recursive_desc_with_string_natural_options() {
		$array = [
			'numbers' => ['10', '1', '2'],
			'mixed' => [2, '1', '10']
		];

		$expected = [
			'numbers' => ['10', '2', '1'],
			'mixed' => ['10', 2, '1']
		];

		$result = Arr::sort_recursive_desc($array, SORT_NATURAL);

		$this->assertSame($expected, $result);
	}

	public function test_sort_recursive_desc_with_string_sort_options() {
		$array = [
			'numbers' => ['10', '1', '2'],
			'mixed' => [2, '1', '10']
		];

		$expected = [
			'numbers' => ['2', '10', '1'],
			'mixed' => [2, '10', '1']
		];

		$result = Arr::sort_recursive_desc($array, SORT_STRING);

		$this->assertSame($expected, $result);
	}
}
