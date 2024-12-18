<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class PrependTest extends ArraysTestCase {
	public function test_prepend_without_key() {
		$array = ['one', 'two', 'three'];
		$expected = ['zero', 'one', 'two', 'three'];

		$this->assertSame($expected, Arr::prepend($array, 'zero'));
	}

	public function test_prepend_with_key() {
		$array = ['one' => 1, 'two' => 2];
		$expected = ['zero' => 0, 'one' => 1, 'two' => 2];

		$this->assertSame($expected, Arr::prepend($array, 0, 'zero'));
	}

	public function test_prepend_to_empty_array() {
		$array = [];
		$expected = ['first' => 1];

		$this->assertSame($expected, Arr::prepend($array, 1, 'first'));
	}

	public function test_prepend_with_numeric_keys() {
		$array = [1 => 'one', 2 => 'two'];
		$expected = [0 => 'zero', 1 => 'one', 2 => 'two'];

		$this->assertSame($expected, Arr::prepend($array, 'zero', 0));
	}

	public function test_prepend_with_null_value() {
		$array = ['one' => 1, 'two' => 2];
		$expected = ['zero' => null, 'one' => 1, 'two' => 2];

		$this->assertSame($expected, Arr::prepend($array, null, 'zero'));
	}

	public function test_prepend_without_key_preserves_numeric_keys() {
		$array = [1 => 'one', 2 => 'two'];
		$expected = [0 => 'zero', 1 => 'one', 2 => 'two'];

		$this->assertSame($expected, Arr::prepend($array, 'zero'));
	}

	public function test_prepend_with_existing_key() {
		$array = ['one' => 1, 'two' => 2];
		$expected = ['one' => 0, 'two' => 2];

		$this->assertSame($expected, Arr::prepend($array, 0, 'one'));
	}

	public function test_prepend_with_array_value() {
		$array = ['one' => 1, 'two' => 2];
		$expected = ['zero' => ['a' => 1, 'b' => 2], 'one' => 1, 'two' => 2];

		$this->assertSame($expected, Arr::prepend($array, ['a' => 1, 'b' => 2], 'zero'));
	}

	public function test_prepend_to_sequential_array() {
		$array = ['apple', 'banana', 'cherry'];
		$expected = ['zero', 'apple', 'banana', 'cherry'];

		$this->assertSame($expected, Arr::prepend($array, 'zero'));
	}
}
