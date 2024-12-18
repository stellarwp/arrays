<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class FirstTest extends ArraysTestCase {

	public function first_data_provider() {
		return [
			'empty_array' => [
				'array' => [],
				'default' => null,
				'expected' => null,
			],
			'simple_indexed_array' => [
				'array' => [ 'first', 'second', 'third' ],
				'default' => null,
				'expected' => 'first',
			],
			'associative_array' => [
				'array' => [
					'foo' => 'bar',
					'baz' => 'qux',
				],
				'default' => null,
				'expected' => 'bar',
			],
			'array_with_default' => [
				'array' => [],
				'default' => 'default_value',
				'expected' => 'default_value',
			],
			'array_with_null_first_value' => [
				'array' => [ null, 'second', 'third' ],
				'default' => 'default_value',
				'expected' => null,
			],
			'array_with_false_first_value' => [
				'array' => [ false, 'second', 'third' ],
				'default' => 'default_value',
				'expected' => false,
			],
			'array_with_zero_first_value' => [
				'array' => [ 0, 'second', 'third' ],
				'default' => 'default_value',
				'expected' => 0,
			],
			'array_with_empty_string_first_value' => [
				'array' => [ '', 'second', 'third' ],
				'default' => 'default_value',
				'expected' => '',
			],
			'array_with_callback' => [
				'array' => [ 1, 2, 3, 4, 5 ],
				'default' => null,
				'expected' => 3,
				'callback' => static function( $value ) {
					return $value > 2;
				},
			],
			'array_with_failing_callback' => [
				'array' => [ 1, 2, 3, 4, 5 ],
				'default' => 'not_found',
				'expected' => 'not_found',
				'callback' => static function( $value ) {
					return $value > 10;
				},
			],
			'array_with_key_value_callback' => [
				'array' => [
					'foo' => 1,
					'bar' => 2,
					'baz' => 3,
				],
				'default' => null,
				'expected' => 2,
				'callback' => static function( $value, $key ) {
					return $key === 'bar';
				},
			],
			'empty_array_with_callback' => [
				'array' => [],
				'default' => 'empty',
				'expected' => 'empty',
				'callback' => static function( $value ) {
					return $value > 2;
				},
			],
		];
	}

	/**
	 * @dataProvider first_data_provider
	 */
	public function test_first( $array, $default, $expected, $callback = null ) {
		if ( null !== $callback ) {
			$result = Arr::first( $array, $callback, $default );
		} else {
			$result = Arr::first( $array, null, $default );
		}

		$this->assertSame( $expected, $result );
	}
}
