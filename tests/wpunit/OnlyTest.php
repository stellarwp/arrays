<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class OnlyTest extends ArraysTestCase {
	public function test_only_with_single_key() {
		$array = ['name' => 'John', 'age' => 30, 'city' => 'New York'];
		$expected = ['name' => 'John'];

		$this->assertSame($expected, Arr::only($array, 'name'));
	}

	public function test_only_with_multiple_keys() {
		$array = ['name' => 'John', 'age' => 30, 'city' => 'New York'];
		$expected = ['name' => 'John', 'city' => 'New York'];

		$this->assertSame($expected, Arr::only($array, ['name', 'city']));
	}

	public function test_only_with_nonexistent_keys() {
		$array = ['name' => 'John', 'age' => 30];
		$expected = [];

		$this->assertSame($expected, Arr::only($array, 'email'));
	}

	public function test_only_with_mixed_existing_and_nonexistent_keys() {
		$array = ['name' => 'John', 'age' => 30, 'city' => 'New York'];
		$expected = ['name' => 'John'];

		$this->assertSame($expected, Arr::only($array, ['name', 'email']));
	}

	public function test_only_with_numeric_keys() {
		$array = [10 => 'ten', 20 => 'twenty', 30 => 'thirty'];
		$expected = [10 => 'ten', 30 => 'thirty'];

		$this->assertSame($expected, Arr::only($array, [10, 30]));
	}

	public function test_only_with_empty_array() {
		$array = [];
		$expected = [];

		$this->assertSame($expected, Arr::only($array, ['name', 'age']));
	}

	public function test_only_with_empty_keys() {
		$array = ['name' => 'John', 'age' => 30];
		$expected = [];

		$this->assertSame($expected, Arr::only($array, []));
	}

	public function test_only_preserves_original_keys() {
		$array = [
			'first' => 1,
			'second' => 2,
			'third' => 3,
			'fourth' => 4,
		];
		$expected = [
			'second' => 2,
			'fourth' => 4,
		];

		$this->assertSame($expected, Arr::only($array, ['second', 'fourth']));
	}

	public function test_only_with_null_values() {
		$array = ['name' => 'John', 'email' => null, 'age' => 30];
		$expected = ['name' => 'John', 'email' => null];

		$this->assertSame($expected, Arr::only($array, ['name', 'email']));
	}

	public function test_only_with_mixed_key_types() {
		$array = [
			'string_key' => 'value1',
			42 => 'value2',
			'another_key' => 'value3',
		];
		$expected = [
			'string_key' => 'value1',
			42 => 'value2',
		];

		$this->assertSame($expected, Arr::only($array, ['string_key', 42]));
	}
}
