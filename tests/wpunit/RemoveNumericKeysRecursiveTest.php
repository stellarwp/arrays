<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class RemoveNumericKeysRecursiveTest extends ArraysTestCase {
	public function test_remove_numeric_keys_simple_array() {
		$array = [0 => 'a', 'name' => 'John', 1 => 'b'];
		$expected = ['name' => 'John'];

		$result = Arr::remove_numeric_keys_recursive($array);

		$this->assertSame($expected, $result);
	}

	public function test_remove_numeric_keys_nested_arrays() {
		$array = [
			0 => 'first',
			'user' => [
				0 => 'John',
				'age' => 30,
				1 => 'Doe'
			],
			1 => 'second'
		];

		$expected = [
			'user' => [
				'age' => 30
			]
		];

		$result = Arr::remove_numeric_keys_recursive($array);

		$this->assertSame($expected, $result);
	}

	public function test_remove_numeric_keys_deeply_nested() {
		$array = [
			'users' => [
				0 => [
					'name' => 'John',
					0 => 'data1',
					1 => 'data2'
				],
				1 => [
					'name' => 'Jane',
					0 => 'info1'
				]
			]
		];

		$expected = [
			'users' => []
		];

		$result = Arr::remove_numeric_keys_recursive($array);

		$this->assertSame($expected, $result);
	}

	public function test_remove_numeric_keys_string_numbers() {
		$array = [
			'1' => 'one',
			'name' => 'John',
			'2' => 'two',
			'age' => 30
		];

		$expected = [
			'name' => 'John',
			'age' => 30
		];

		$result = Arr::remove_numeric_keys_recursive($array);

		$this->assertSame($expected, $result);
	}

	public function test_remove_numeric_keys_empty_array() {
		$array = [];
		$expected = [];

		$result = Arr::remove_numeric_keys_recursive($array);

		$this->assertSame($expected, $result);
	}

	public function test_remove_numeric_keys_mixed_types() {
		$array = [
			0 => null,
			'name' => 'John',
			1 => true,
			'data' => [
				0 => 123,
				'type' => 'user',
				1 => false
			]
		];

		$expected = [
			'name' => 'John',
			'data' => [
				'type' => 'user'
			]
		];

		$result = Arr::remove_numeric_keys_recursive($array);

		$this->assertSame($expected, $result);
	}

	public function test_remove_numeric_keys_preserves_array_structure() {
		$array = [
			'items' => [
				0 => ['id' => 1],
				1 => ['id' => 2]
			]
		];

		$expected = [
			'items' => []
		];

		$result = Arr::remove_numeric_keys_recursive($array);

		$this->assertSame($expected, $result);
	}
}
