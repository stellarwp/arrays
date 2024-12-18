<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class MergeRecursiveTest extends ArraysTestCase {
	public function test_merge_recursive_with_simple_arrays() {
		$array1 = ['a' => 1, 'b' => 2];
		$array2 = ['b' => 3, 'c' => 4];

		$expected = ['a' => 1, 'b' => 3, 'c' => 4];
		$this->assertSame($expected, Arr::merge_recursive($array1, $array2));
	}

	public function test_merge_recursive_with_nested_arrays() {
		$array1 = [
			'a' => ['x' => 1, 'y' => 2],
			'b' => 3,
		];
		$array2 = [
			'a' => ['y' => 3, 'z' => 4],
			'c' => 5,
		];

		$expected = [
			'a' => ['x' => 1, 'y' => 3, 'z' => 4],
			'b' => 3,
			'c' => 5,
		];
		$this->assertSame($expected, Arr::merge_recursive($array1, $array2));
	}

	public function test_merge_recursive_with_deep_nested_arrays() {
		$array1 = [
			'a' => [
				'b' => [
					'c' => 1,
					'd' => 2,
				],
			],
		];
		$array2 = [
			'a' => [
				'b' => [
					'd' => 3,
					'e' => 4,
				],
			],
		];

		$expected = [
			'a' => [
				'b' => [
					'c' => 1,
					'd' => 3,
					'e' => 4,
				],
			],
		];
		$this->assertSame($expected, Arr::merge_recursive($array1, $array2));
	}

	public function test_merge_recursive_with_numeric_keys() {
		$array1 = ['a', 'b'];
		$array2 = ['c', 'd'];

		$expected = ['a', 'b', 'c', 'd'];
		$this->assertSame($expected, Arr::merge_recursive($array1, $array2));
	}

	public function test_merge_recursive_with_mixed_keys() {
		$array1 = ['a' => 1, 'numbers' => [1, 2]];
		$array2 = ['a' => 2, 'numbers' => [3, 4]];

		$expected = ['a' => 2, 'numbers' => [1, 2, 3, 4]];
		$this->assertSame($expected, Arr::merge_recursive($array1, $array2));
	}

	public function test_merge_recursive_with_nested_numeric_arrays() {
		$array1 = [
			'list1' => [1, 2, 3],
			'list2' => [4, 5],
		];
		$array2 = [
			'list1' => [6, 7],
			'list2' => [8],
		];

		$expected = [
			'list1' => [1, 2, 3, 6, 7],
			'list2' => [4, 5, 8],
		];
		$this->assertSame($expected, Arr::merge_recursive($array1, $array2));
	}

	public function test_merge_recursive_with_empty_arrays() {
		$array1 = [];
		$array2 = ['a' => 1, 'b' => 2];

		$this->assertSame($array2, Arr::merge_recursive($array1, $array2));

		$array1 = ['a' => 1, 'b' => 2];
		$array2 = [];

		$this->assertSame($array1, Arr::merge_recursive($array1, $array2));
	}

	public function test_merge_recursive_with_null_values() {
		$array1 = ['a' => 1, 'b' => null];
		$array2 = ['b' => 2, 'c' => null];

		$expected = ['a' => 1, 'b' => 2, 'c' => null];
		$this->assertSame($expected, Arr::merge_recursive($array1, $array2));
	}

	public function test_merge_recursive_with_mixed_types() {
		$array1 = ['a' => 1, 'b' => 'string', 'nums' => [1, 2]];
		$array2 = ['b' => 2.5, 'nums' => [3, 4]];

		$expected = ['a' => 1, 'b' => 2.5, 'nums' => [1, 2, 3, 4]];
		$this->assertSame($expected, Arr::merge_recursive($array1, $array2));
	}

	public function test_merge_recursive_deep_numeric_arrays() {
		$array1 = [
			'deep' => [
				'lists' => [
					'a' => [1, 2],
					'b' => [3, 4],
				],
			],
		];
		$array2 = [
			'deep' => [
				'lists' => [
					'a' => [5, 6],
					'b' => [7, 8],
				],
			],
		];

		$expected = [
			'deep' => [
				'lists' => [
					'a' => [1, 2, 5, 6],
					'b' => [3, 4, 7, 8],
				],
			],
		];
		$this->assertSame($expected, Arr::merge_recursive($array1, $array2));
	}
}
