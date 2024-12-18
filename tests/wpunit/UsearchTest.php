<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class UsearchTest extends ArraysTestCase {

	public function usearch_data_provider() {
		$value_gt_needle = static function ( $needle, $value ): bool {
			return $value > $needle;
		};
		$matches_needle = static function ( $needle, $value ): bool {
			return $value === $needle;
		};
		$callback_using_value_and_key = static function ( $needle, $value, $key ): bool {
			return $value === $needle && $key === 'three';
		};

		return [
			'empty haysatck'                                    => [ 'foo', [], false, $value_gt_needle ],
			'haystack not contains needle'                      => [
				23,
				[ 'foo', 'bar', 'baz' ],
				false,
				$value_gt_needle
			],
			'haystack contains 1 needle'                        => [ 23, [ 89, 23, 113, 17 ], 1, $matches_needle ],
			'haystack contains multiple needles'                => [
				23,
				[ 89, 23, 113, 17, 23, 11, 23 ],
				1,
				$matches_needle
			],
			'haystack contains multiple needles w/ string keys' => [
				23,
				[ 'one' => 89, 'two' => 23, 'three' => 23 ],
				'two',
				$matches_needle
			],
			'callback using value and key'                      => [
				23,
				[ 'one' => 89, 'two' => 23, 'three' => 23 ],
				'three',
				$callback_using_value_and_key
			],
		];
	}

	/**
	 * @dataProvider usearch_data_provider
	 */
	public function test_usearch( $needle, array $haystack, $expected, callable $callback ) {
		$this->assertEquals( $expected, Arr::usearch( $needle, $haystack, $callback ) );
	}
}
