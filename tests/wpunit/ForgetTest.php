<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class ForgetTest extends ArraysTestCase {

	public function forget_data_provider() {
		return [
			'simple_key' => [
				'array' => ['foo' => 'bar'],
				'keys' => 'foo',
				'expected' => []
			],
			'nested_key' => [
				'array' => ['foo' => ['bar' => 'baz', 'other' => 'value']],
				'keys' => 'foo.bar',
				'expected' => ['foo' => ['other' => 'value']]
			],
			'multiple_nested_keys' => [
				'array' => [
					'foo' => ['bar' => 'baz', 'other' => 'value'],
					'bar' => ['baz' => 'qux']
				],
				'keys' => ['foo.bar', 'bar.baz'],
				'expected' => [
					'foo' => ['other' => 'value'],
					'bar' => []
				]
			],
			'parent_key' => [
				'array' => ['foo' => ['bar' => 'baz', 'other' => 'value']],
				'keys' => 'foo',
				'expected' => []
			],
			'deep_nested' => [
				'array' => [
					'level1' => [
						'level2' => [
							'level3' => 'value',
							'keep' => 'this'
						]
					]
				],
				'keys' => 'level1.level2.level3',
				'expected' => [
					'level1' => [
						'level2' => [
							'keep' => 'this'
						]
					]
				]
			],
			'multiple_keys' => [
				'array' => [
					'key1' => 'value1',
					'key2' => 'value2',
					'key3' => 'value3'
				],
				'keys' => ['key1', 'key3'],
				'expected' => [
					'key2' => 'value2'
				]
			],
		];
	}

	/**
	 * @dataProvider forget_data_provider
	 */
	public function test_forget($array, $keys, $expected) {
		$original = $array;
		Arr::forget($array, $keys);
		$this->assertEquals($expected, $array);

		// Test that the method modifies the array by reference
		$this->assertNotEquals($original, $array);
	}

	public function test_forget_missing_key() {
		$array = ['foo' => 'bar'];
		$key = 'missing';
		$expected = ['foo' => 'bar'];
		Arr::forget($array, $key);
		$this->assertEquals($expected, $array);
	}

	public function test_forget_non_existent_path() {
		$array = ['foo' => ['bar' => 'baz']];
		$key = 'foo.bar.baz';
		$expected = ['foo' => ['bar' => 'baz']];
		Arr::forget($array, $key);
		$this->assertEquals($expected, $array);
	}
}
