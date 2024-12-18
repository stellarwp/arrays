<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class AddUnprefixedKeysToTest extends ArraysTestCase {

	public function unprefix_keys() {
		return [
			'a_string'                     => [ 'foo', 'foo' ],
			'null'                         => [ null, null ],
			'an_object'                    => [ (object) [ '_foo' => 'bar' ], (object) [ '_foo' => 'bar' ] ],
			'no_prefix'                    => [ [ 'foo' => 'bar' ], [ 'foo' => 'bar' ] ],
			'w_prefix'                     => [ [ '_foo' => 'bar' ], [ '_foo' => 'bar', 'foo' => 'bar' ] ],
			'w_prefix_nested'              => [
				[ '_foo' => [ 'bar' => 23, '_baz' => 89 ] ],
				[
					'_foo' => [ 'bar' => 23, '_baz' => 89, 'baz' => 89 ],
					'foo'  => [ 'bar' => 23, '_baz' => 89, 'baz' => 89 ]
				],
				true
			],
			'w_prefix_nested_no_recursion' => [
				[ '_foo' => [ 'bar' => 23, '_baz' => 89 ] ],
				[
					'_foo' => [ 'bar' => 23, '_baz' => 89 ],
					'foo'  => [ 'bar' => 23, '_baz' => 89 ]
				]
			],
		];
	}

	/**
	 * Test unprefix array keys
	 * @dataProvider unprefix_keys
	 */
	public function test_unprefix_array_keys( $input, $expected, bool $recursive = false ) {
		$this->assertEquals( $expected, Arr::add_unprefixed_keys_to( $input, $recursive ) );
	}
}
