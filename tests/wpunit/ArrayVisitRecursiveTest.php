<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;
use PHPUnit\Framework\AssertionFailedError;

final class ArrayVisitRecursiveTest extends ArraysTestCase {

	public function array_visit_recursive_data_provider() {
		$throw_on_call = static function () {
			throw new AssertionFailedError( 'This function should not be called' );
		};

		$drop_even = static function ( $key, $value ) {
			if ( $value % 2 === 0 ) {
				return false;
			}
		};

		return [
			'empty input'                => [
				'input'    => [],
				'visitor'  => $throw_on_call,
				'expected' => [],
			],
			'drop even values'           => [
				'input'    => [ 1, 2, 3, 4, 5, 6 ],
				'visitor'  => $drop_even,
				'expected' => [ 1, 3, 5 ],
			],
			'recursive drop even values' => [
				'input'    => [ 1, 2, 3, 4, 5, 6, [ 1, 2, 3 ], [ 4, 5, 6 ] ],
				'visitor'  => $drop_even,
				'expected' => [ 1, 3, 5, [ 1, 2 => 3 ], [ 1 => 5 ] ],
			],
			'recursive visit'            => [
				'input'    => [
					'lorem' => [
						1,
						2,
						3,
					],
					[
						'foo',
						'baz',
						'bar',
					],
					'dolor' => [
						'sit' => [ 'woot' => 23, 'waz' ]
					],
				],
				'visitor'  => static function ( $key, $value ) {
					$new_key   = is_numeric( $key ) ? 'n_' . $key : 's_' . $key;
					if ( ! is_array( $value ) ) {
						$new_value = is_string( $value ) ? 'is_string' : 'not_string';
					} else {
						$new_value = $value;
					}

					if ( $key === 'foo' ) {
						return false;
					}

					return [ $new_key, $new_value ];
				},
				'expected' => [
					's_lorem' =>
						[
							'n_0' => 'not_string',
							'n_1' => 'not_string',
							'n_2' => 'not_string',
						],
					'n_0'     =>
						[
							'n_0' => 'is_string',
							'n_1' => 'is_string',
							'n_2' => 'is_string',
						],
					's_dolor' =>
						[
							's_sit' =>
								[
									's_woot' => 'not_string',
									'n_0'    => 'is_string',
								],
						],
				],
			],
		];
	}

	/**
	 * @dataProvider array_visit_recursive_data_provider
	 */
	public function test_array_visit_recursive( $input, $visitor, $expected ) {
		$this->assertEqualSets( $expected, Arr::array_visit_recursive( $input, $visitor ) );
	}
}
