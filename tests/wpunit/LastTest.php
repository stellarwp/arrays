<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class LastTest extends ArraysTestCase {
	public function test_last_with_empty_array() {
		$array = [];
		$default = 'default';
		$this->assertSame($default, Arr::last($array, null, $default));
	}

	public function test_last_with_single_element() {
		$array = ['one'];
		$this->assertSame('one', Arr::last($array));
	}

	public function test_last_with_multiple_elements() {
		$array = ['one', 'two', 'three'];
		$this->assertSame('three', Arr::last($array));
	}

	public function test_last_with_associative_array() {
		$array = ['first' => 'one', 'second' => 'two', 'third' => 'three'];
		$this->assertSame('three', Arr::last($array));
	}

	public function test_last_with_callback() {
		$array = [1, 2, 3, 4, 5];
		$result = Arr::last($array, function($value) {
			return $value < 4;
		});
		$this->assertSame(3, $result);
	}

	public function test_last_with_callback_no_match() {
		$array = [1, 2, 3, 4, 5];
		$default = 'default';
		$result = Arr::last($array, function($value) {
			return $value > 10;
		}, $default);
		$this->assertSame($default, $result);
	}

	public function test_last_with_callback_and_key() {
		$array = ['a' => 1, 'b' => 2, 'c' => 3];
		$result = Arr::last($array, function($value, $key) {
			return $key === 'b';
		});
		$this->assertSame(2, $result);
	}

	public function test_last_with_mixed_types() {
		$array = [1, 'two', 3.0, true, null];
		$this->assertNull(Arr::last($array));
	}

	public function test_last_preserves_zero() {
		$array = ['one', 'two', 0];
		$this->assertSame(0, Arr::last($array));
	}

	public function test_last_with_nested_arrays() {
		$array = ['one', ['nested'], 'three'];
		$this->assertSame('three', Arr::last($array));
	}

	public function test_last_with_false_values() {
		$array = ['one', false, 'three'];
		$this->assertSame('three', Arr::last($array));
	}

	public function test_last_with_callback_on_objects() {
		$obj1 = new \stdClass();
		$obj1->value = 1;
		$obj2 = new \stdClass();
		$obj2->value = 2;
		$obj3 = new \stdClass();
		$obj3->value = 3;

		$array = [$obj1, $obj2, $obj3];
		$result = Arr::last($array, function($obj) {
			return $obj->value < 3;
		});
		$this->assertSame($obj2, $result);
	}
}
