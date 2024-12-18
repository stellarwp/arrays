<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class InsertBeforeKeyTest extends ArraysTestCase {
	public function insert_before_key_data_provider() {
		return [
			'insert_single_value' => [
				'key' => 'b',
				'source_array' => ['a' => 1, 'b' => 2, 'c' => 3],
				'insert' => ['new' => 4],
				'expected' => ['a' => 1, 'new' => 4, 'b' => 2, 'c' => 3],
			],
			'insert_multiple_values' => [
				'key' => 'b',
				'source_array' => ['a' => 1, 'b' => 2, 'c' => 3],
				'insert' => ['new1' => 4, 'new2' => 5],
				'expected' => ['a' => 1, 'new1' => 4, 'new2' => 5, 'b' => 2, 'c' => 3],
			],
			'insert_before_first_key' => [
				'key' => 'a',
				'source_array' => ['a' => 1, 'b' => 2, 'c' => 3],
				'insert' => ['new' => 4],
				'expected' => ['new' => 4, 'a' => 1, 'b' => 2, 'c' => 3],
			],
			'insert_before_last_key' => [
				'key' => 'c',
				'source_array' => ['a' => 1, 'b' => 2, 'c' => 3],
				'insert' => ['new' => 4],
				'expected' => ['a' => 1, 'b' => 2, 'new' => 4, 'c' => 3],
			],
			'insert_before_numeric_key' => [
				'key' => 1,
				'source_array' => [0 => 'a', 1 => 'b', 2 => 'c'],
				'insert' => ['new' => 'd'],
				'expected' => [0 => 'a', 'new' => 'd', 1 => 'b', 2 => 'c'],
			],
			'insert_single_non_array_value' => [
				'key' => 'b',
				'source_array' => ['a' => 1, 'b' => 2, 'c' => 3],
				'insert' => 4,
				'expected' => ['a' => 1, 0 => 4, 'b' => 2, 'c' => 3],
			],
			'key_not_found' => [
				'key' => 'not_exists',
				'source_array' => ['a' => 1, 'b' => 2, 'c' => 3],
				'insert' => ['new' => 4],
				'expected' => ['a' => 1, 'b' => 2, 'c' => 3, 'new' => 4],
			],
			'empty_source_array' => [
				'key' => 'any',
				'source_array' => [],
				'insert' => ['new' => 1],
				'expected' => ['new' => 1],
			],
			'empty_insert_array' => [
				'key' => 'b',
				'source_array' => ['a' => 1, 'b' => 2, 'c' => 3],
				'insert' => [],
				'expected' => ['a' => 1, 'b' => 2, 'c' => 3],
			],
			'mixed_key_types' => [
				'key' => 1,
				'source_array' => ['string_key' => 'a', 1 => 'b', 2 => 'c'],
				'insert' => ['new' => 'd'],
				'expected' => ['string_key' => 'a', 'new' => 'd', 1 => 'b', 2 => 'c'],
			],
		];
	}

	/**
	 * @dataProvider insert_before_key_data_provider
	 */
	public function test_insert_before_key($key, $source_array, $insert, $expected) {
		$this->assertSame(
			$expected,
			Arr::insert_before_key($key, $source_array, $insert)
		);
	}
}
