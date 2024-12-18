<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class GetFirstSetTest extends ArraysTestCase {

	public function get_first_set_data_sets() {
		return [
			// $input, $indexes, $default, $expected
			'empty'                  => [ [], [ 'tree', 'car' ], null, null ],
			'first_element'          => [ [ 'tree' => 'pine', 'animal' => 'bear' ], [ 'tree', 'car' ], null, 'pine' ],
			'second_element'         => [ [ 'animal' => 'bear', 'tree' => 'pine' ], [ 'tree', 'car' ], null, 'pine' ],
			'first_index_set_second' => [ [ 'car' => 'VW Golf', 'tree' => 'pine' ], [ 'tree', 'car' ], null, 'pine' ],
			'first_index_set_first'  => [ [ 'car' => 'VW Golf', 'tree' => 'pine' ], [ 'car', 'tree' ], null, 'VW Golf' ],
			'not_set_wo_default'     => [ [ 'car' => 'VW Golf', 'tree' => 'pine' ], [ 'one', 'two' ], null, null ],
			'not_set_w_default'      => [ [ 'car' => 'VW Golf', 'tree' => 'pine' ], [ 'one', 'two' ], 'default', 'default' ],
		];
	}

	/**
	 * Test get_first_set
	 * @dataProvider get_first_set_data_sets
	 */
	public function test_get_first_set( $input, $indexes, $default, $expected ) {
		$this->assertEquals( $expected, Arr::get_first_set( $input, $indexes, $default ) );
	}
}
