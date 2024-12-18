<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class StringifyKeysTest extends ArraysTestCase {
	public function test_stringify_keys_simple_array() {
		$array = [0 => 'a', 1 => 'b', 2 => 'c'];
		$result = Arr::stringify_keys($array, 'test_');

		$this->assertSame('test_0', array_keys($result)[0]);
		$this->assertSame('test_1', array_keys($result)[1]);
		$this->assertSame('test_2', array_keys($result)[2]);
		$this->assertSame(['a', 'b', 'c'], array_values($result));
	}

	public function test_stringify_keys_mixed_array() {
		$array = [
			0 => 'zero',
			'name' => 'John',
			1 => 'one',
			'age' => 30
		];

		$result = Arr::stringify_keys($array, 'prefix_');

		$this->assertSame('prefix_0', array_keys($result)[0]);
		$this->assertSame('name', array_keys($result)[1]);
		$this->assertSame('prefix_1', array_keys($result)[2]);
		$this->assertSame('age', array_keys($result)[3]);
		$this->assertSame(['zero', 'John', 'one', 30], array_values($result));
	}

	public function test_stringify_keys_nested_arrays() {
		$array = [
			0 => [
				1 => 'nested',
				'key' => 'value'
			],
			'parent' => [
				0 => 'child',
				1 => 'another'
			]
		];

		$result = Arr::stringify_keys($array, 'test_');

		$this->assertSame('test_0', array_keys($result)[0]);
		$this->assertSame('parent', array_keys($result)[1]);

		$nested = $result['test_0'];
		$this->assertSame('test_1', array_keys($nested)[0]);
		$this->assertSame('key', array_keys($nested)[1]);

		$parent = $result['parent'];
		$this->assertSame('test_0', array_keys($parent)[0]);
		$this->assertSame('test_1', array_keys($parent)[1]);
	}

	public function test_stringify_keys_empty_array() {
		$array = [];
		$result = Arr::stringify_keys($array, 'test_');

		$this->assertSame([], $result);
	}

	public function test_stringify_keys_without_prefix() {
		$array = [0 => 'a', 1 => 'b'];
		$result = Arr::stringify_keys($array);

		// Check that keys are stringified with the default prefix pattern
		$this->assertEquals(1, preg_match('/^sk_[0-9a-f]+$/', array_keys($result)[0]));
		$this->assertEquals(1, preg_match('/^sk_[0-9a-f]+$/', array_keys($result)[1]));
		$this->assertSame(['a', 'b'], array_values($result));
	}

	public function test_stringify_keys_preserves_string_keys() {
		$array = [
			'string_key' => 'value',
			0 => 'numeric',
			'another' => 'string'
		];

		$result = Arr::stringify_keys($array, 'prefix_');

		$this->assertSame('string_key', array_keys($result)[0]);
		$this->assertSame('prefix_0', array_keys($result)[1]);
		$this->assertSame('another', array_keys($result)[2]);
	}
}
