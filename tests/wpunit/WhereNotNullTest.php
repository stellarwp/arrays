<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class WhereNotNullTest extends ArraysTestCase {
	public function test_where_not_null_basic_array() {
		$array = [
			'a' => 1,
			'b' => null,
			'c' => 3,
			'd' => null,
			'e' => 5
		];

		$result = Arr::where_not_null($array);

		$this->assertSame([
			'a' => 1,
			'c' => 3,
			'e' => 5
		], $result);
	}

	public function test_where_not_null_empty_array() {
		$array = [];

		$result = Arr::where_not_null($array);

		$this->assertSame([], $result);
	}

	public function test_where_not_null_all_null_values() {
		$array = [
			'a' => null,
			'b' => null,
			'c' => null
		];

		$result = Arr::where_not_null($array);

		$this->assertSame([], $result);
	}

	public function test_where_not_null_preserves_keys() {
		$array = [
			0 => null,
			1 => 'first',
			2 => null,
			3 => 'second',
			4 => null
		];

		$result = Arr::where_not_null($array);

		$this->assertSame([
			1 => 'first',
			3 => 'second'
		], $result);
	}

	public function test_where_not_null_with_mixed_types() {
		$array = [
			'string' => 'value',
			'null' => null,
			'zero' => 0,
			'false' => false,
			'empty' => '',
			'array' => [],
			'null_again' => null
		];

		$result = Arr::where_not_null($array);

		$this->assertSame([
			'string' => 'value',
			'zero' => 0,
			'false' => false,
			'empty' => '',
			'array' => []
		], $result);
	}

	public function test_where_not_null_with_nested_arrays() {
		$array = [
			'a' => ['value' => 1],
			'b' => null,
			'c' => ['value' => null],
			'd' => ['nested' => ['deep' => null]]
		];

		$result = Arr::where_not_null($array);

		$this->assertSame([
			'a' => ['value' => 1],
			'c' => ['value' => null],
			'd' => ['nested' => ['deep' => null]]
		], $result);
	}
}
