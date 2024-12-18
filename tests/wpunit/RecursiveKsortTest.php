<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class RecursiveKsortTest extends ArraysTestCase {
	public function test_recursive_ksort_simple_array() {
		$array = ['c' => 3, 'a' => 1, 'b' => 2];
		$expected = ['a' => 1, 'b' => 2, 'c' => 3];

		$result = Arr::recursive_ksort($array);

		$this->assertTrue($result);
		$this->assertSame($expected, $array);
	}

	public function test_recursive_ksort_nested_arrays() {
		$array = [
			'c' => ['z' => 3, 'x' => 1, 'y' => 2],
			'a' => ['c' => 3, 'a' => 1, 'b' => 2],
			'b' => ['b' => 2, 'c' => 3, 'a' => 1],
		];

		$expected = [
			'a' => ['a' => 1, 'b' => 2, 'c' => 3],
			'b' => ['a' => 1, 'b' => 2, 'c' => 3],
			'c' => ['x' => 1, 'y' => 2, 'z' => 3],
		];

		$result = Arr::recursive_ksort($array);

		$this->assertTrue($result);
		$this->assertSame($expected, $array);
	}

	public function test_recursive_ksort_mixed_keys() {
		$array = [
			2 => 'b',
			1 => 'a',
			10 => 'c',
			'nested' => [2 => 'b', 1 => 'a', 10 => 'c']
		];

		$expected = [
			1 => 'a',
			2 => 'b',
			10 => 'c',
			'nested' => [1 => 'a', 2 => 'b', 10 => 'c']
		];

		$result = Arr::recursive_ksort($array);

		$this->assertTrue($result);
		$this->assertSame($expected, $array);
	}

	public function test_recursive_ksort_deeply_nested() {
		$array = [
			'c' => [
				'z' => ['3' => 'c', '1' => 'a', '2' => 'b'],
				'x' => ['c' => 3, 'a' => 1, 'b' => 2],
				'y' => 2
			],
			'a' => 1,
			'b' => 2
		];

		$expected = [
			'a' => 1,
			'b' => 2,
			'c' => [
				'x' => ['a' => 1, 'b' => 2, 'c' => 3],
				'y' => 2,
				'z' => ['1' => 'a', '2' => 'b', '3' => 'c']
			]
		];

		$result = Arr::recursive_ksort($array);

		$this->assertTrue($result);
		$this->assertSame($expected, $array);
	}

	public function test_recursive_ksort_with_empty_arrays() {
		$array = [
			'c' => [],
			'a' => ['c' => [], 'a' => 1, 'b' => []],
			'b' => 2
		];

		$expected = [
			'a' => ['a' => 1, 'b' => [], 'c' => []],
			'b' => 2,
			'c' => []
		];

		$result = Arr::recursive_ksort($array);

		$this->assertTrue($result);
		$this->assertSame($expected, $array);
	}

	public function test_recursive_ksort_with_mixed_value_types() {
		$array = [
			'c' => null,
			'a' => ['c' => true, 'a' => 1, 'b' => 'string'],
			'b' => 2.5
		];

		$expected = [
			'a' => ['a' => 1, 'b' => 'string', 'c' => true],
			'b' => 2.5,
			'c' => null
		];

		$result = Arr::recursive_ksort($array);

		$this->assertTrue($result);
		$this->assertSame($expected, $array);
	}

	public function test_recursive_ksort_empty_array() {
		$array = [];
		$expected = [];

		$result = Arr::recursive_ksort($array);

		$this->assertTrue($result);
		$this->assertSame($expected, $array);
	}
}
