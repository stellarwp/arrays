<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class JoinTest extends ArraysTestCase {
	public function join_data_provider() {
		return [
			'empty_array' => [
				'array' => [],
				'glue' => ', ',
				'finalGlue' => ' and ',
				'expected' => '',
			],
			'single_item' => [
				'array' => ['apple'],
				'glue' => ', ',
				'finalGlue' => ' and ',
				'expected' => 'apple',
			],
			'two_items' => [
				'array' => ['apple', 'banana'],
				'glue' => ', ',
				'finalGlue' => ' and ',
				'expected' => 'apple and banana',
			],
			'three_items' => [
				'array' => ['apple', 'banana', 'orange'],
				'glue' => ', ',
				'finalGlue' => ' and ',
				'expected' => 'apple, banana and orange',
			],
			'multiple_items' => [
				'array' => ['apple', 'banana', 'orange', 'grape', 'mango'],
				'glue' => ', ',
				'finalGlue' => ' and ',
				'expected' => 'apple, banana, orange, grape and mango',
			],
			'no_final_glue' => [
				'array' => ['apple', 'banana', 'orange'],
				'glue' => ', ',
				'finalGlue' => '',
				'expected' => 'apple, banana, orange',
			],
			'custom_glue' => [
				'array' => ['apple', 'banana', 'orange'],
				'glue' => ' | ',
				'finalGlue' => ' or ',
				'expected' => 'apple | banana or orange',
			],
			'numeric_values' => [
				'array' => [1, 2, 3, 4],
				'glue' => ', ',
				'finalGlue' => ' and ',
				'expected' => '1, 2, 3 and 4',
			],
			'mixed_values' => [
				'array' => ['apple', 1, 'banana', 2],
				'glue' => ', ',
				'finalGlue' => ' and ',
				'expected' => 'apple, 1, banana and 2',
			],
			'empty_glue' => [
				'array' => ['apple', 'banana', 'orange'],
				'glue' => '',
				'finalGlue' => ' and ',
				'expected' => 'applebanana and orange',
			],
		];
	}

	/**
	 * @dataProvider join_data_provider
	 */
	public function test_join(array $array, string $glue, string $finalGlue, string $expected) {
		$this->assertSame($expected, Arr::join($array, $glue, $finalGlue));
	}
}
