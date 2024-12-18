<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class WhereTest extends ArraysTestCase {
	public function test_where_with_value_callback() {
		$array = [1, 2, 3, 4, 5];
		$result = Arr::where($array, function($value) {
			return $value > 3;
		});

		$this->assertSame([3 => 4, 4 => 5], $result);
	}

	public function test_where_with_key_and_value_callback() {
		$array = ['a' => 1, 'b' => 2, 'c' => 3];
		$result = Arr::where($array, function($value, $key) {
			return $key === 'b' || $value === 3;
		});

		$this->assertSame(['b' => 2, 'c' => 3], $result);
	}

	public function test_where_with_empty_array() {
		$array = [];
		$result = Arr::where($array, function($value) {
			return true;
		});

		$this->assertSame([], $result);
	}

	public function test_where_with_associative_array() {
		$array = [
			'name' => 'John',
			'age' => 25,
			'city' => 'New York',
			'active' => true
		];

		$result = Arr::where($array, function($value, $key) {
			return is_string($value);
		});

		$this->assertSame([
			'name' => 'John',
			'city' => 'New York'
		], $result);
	}

	public function test_where_with_nested_arrays() {
		$array = [
			['id' => 1, 'active' => true],
			['id' => 2, 'active' => false],
			['id' => 3, 'active' => true]
		];

		$result = Arr::where($array, function($value) {
			return isset($value['active']) && $value['active'] === true;
		});

		$this->assertSame([
			0 => ['id' => 1, 'active' => true],
			2 => ['id' => 3, 'active' => true]
		], $result);
	}

	public function test_where_with_type_checking() {
		$array = [
			'string' => 'value',
			'int' => 42,
			'bool' => true,
			'array' => [],
			'null' => null
		];

		$result = Arr::where($array, function($value) {
			return is_scalar($value);
		});

		$this->assertSame([
			'string' => 'value',
			'int' => 42,
			'bool' => true
		], $result);
	}

	public function test_where_preserves_keys() {
		$array = [
			10 => 'a',
			20 => 'b',
			30 => 'c'
		];

		$result = Arr::where($array, function($value) {
			return $value !== 'b';
		});

		$this->assertSame([
			10 => 'a',
			30 => 'c'
		], $result);
	}
}
