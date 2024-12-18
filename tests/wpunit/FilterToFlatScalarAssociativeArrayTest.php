<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class FilterToFlatScalarAssociativeArrayTest extends ArraysTestCase {

	public function filter_to_flat_scalar_associative_array_data_sets() {
		return [
			// $input, $expected
			'empty'                      => [ [], [] ],
			'all_numeric_keys'           => [ [ 'a', 'b', 'c' ], [] ],
			'all_multi_dimensional'      => [ [ 'letters' => [ 'a', 'b' ] ], [] ],
			'mostly_associative_scalar'  => [
				[ 'a' => 'apple', 'b' => 'banana', 'c' => [ 'multi' ] ],
				[ 'a' => 'apple', 'b' => 'banana' ],
			],
			'already_associative_scalar' => [
				[ 'a' => 'apple', 'b' => 'banana' ],
				[ 'a' => 'apple', 'b' => 'banana' ],
			],
		];
	}

	/**
	 * Test filter_to_flat_scalar_associative_array
	 * @dataProvider filter_to_flat_scalar_associative_array_data_sets
	 */
	public function test_filter_to_flat_scalar_associative_array( $input, $expected ) {
		$this->assertEquals( $expected, Arr::filter_to_flat_scalar_associative_array( $input ) );
	}
}
