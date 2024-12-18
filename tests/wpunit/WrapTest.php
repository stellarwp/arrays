<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class WrapTest extends ArraysTestCase {
	public function test_wrap_null_value() {
		$result = Arr::wrap(null);

		$this->assertSame([], $result);
	}

	public function test_wrap_scalar_value() {
		$result = Arr::wrap('test');

		$this->assertSame(['test'], $result);
	}

	public function test_wrap_array() {
		$array = ['one', 'two', 'three'];
		$result = Arr::wrap($array);

		$this->assertSame($array, $result);
	}

	public function test_wrap_empty_array() {
		$array = [];
		$result = Arr::wrap($array);

		$this->assertSame($array, $result);
	}

	public function test_wrap_integer() {
		$result = Arr::wrap(42);

		$this->assertSame([42], $result);
	}

	public function test_wrap_boolean() {
		$result = Arr::wrap(true);

		$this->assertSame([true], $result);
	}

	public function test_wrap_float() {
		$result = Arr::wrap(3.14);

		$this->assertSame([3.14], $result);
	}

	public function test_wrap_empty_string() {
		$result = Arr::wrap('');

		$this->assertSame([''], $result);
	}

	public function test_wrap_zero() {
		$result = Arr::wrap(0);

		$this->assertSame([0], $result);
	}

	public function test_wrap_associative_array() {
		$array = ['key' => 'value', 'another' => 'test'];
		$result = Arr::wrap($array);

		$this->assertSame($array, $result);
	}
}
