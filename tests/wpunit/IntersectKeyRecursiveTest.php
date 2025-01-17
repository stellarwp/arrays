<?php

namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class IntersectKeyRecursiveTest extends ArraysTestCase {

	public function test_empty_arrays(): void {
		$result = Arr::intersect_key_recursive( [], [] );

		$this->assertSame( [], $result );
	}

	public function test_nested_empty_arrays(): void {
		$array1 = [
			'a' => [],
			'b' => [],
		];

		$array2 = [
			'a' => [],
			'b' => [],
		];

		$result = Arr::intersect_key_recursive( $array1, $array2 );

		$this->assertSame( $array1, $result );
	}

	public function test_with_simple_arrays(): void {
		$array1 = [
			'a' => 1,
			'b' => 22,
			'c' => 33,
		];

		$array2 = [
			'a' => 1,
			'b' => 2,
			'c' => 3,
		];

		$result = Arr::intersect_key_recursive( $array1, $array2 );

		$this->assertSame( [
			'a' => 1,
			'b' => 22,
			'c' => 33,
		], $result );
	}

	public function test_with_no_common_keys(): void {
		$array1 = [
			'x' => 1,
			'y' => 2,
		];

		$array2 = [
			'a' => 1,
			'b' => 2,
			'c' => 3,
		];

		$result = Arr::intersect_key_recursive( $array1, $array2 );

		$this->assertSame( [], $result );
	}

	public function test_nested_arrays(): void {
		$array1 = [
			'a' => 1,
			'b' => [
				'x' => 50,
				'y' => [
					'a' => 11,
					'b' => 10,
				],
			],
			'c' => 33,
			'd' => [
				1,
				2,
			],
		];

		$array2 = [
			'a' => 1,
			'b' => [
				'x' => 5,
				'y' => [
					'a' => 1,
				],
				'z' => 10,
			],
			'c' => 2,
			'd' => [],
		];

		$result = Arr::intersect_key_recursive( $array1, $array2 );

		$this->assertSame([
			'a' => 1,
			'b' => [
				'x' => 50,
				'y' => [
					'a' => 11,
				],
			],
			'c' => 33,
			'd' => [],
		], $result );
	}

	public function test_nested_array_with_type_overrides(): void {
		$array1 = [
			'b' => [
				'one',
				'two',
				'three',
				'four',
			],
			'c' => 'two',
			'd' => 100,
		];

		$array2 = [
			'a' => 1,
			'b' => [
				1,
				2,
				3,
			],
			'c' => 2,
			'd' => [],
		];

		$result = Arr::intersect_key_recursive( $array1, $array2 );

		$this->assertSame( [
			'b' => [
				'one',
				'two',
				'three',
			],
			'c' => 'two',
			'd' => 100,
		], $result );
	}

	public function test_nested_array_with_different_order(): void {
		$array1 = [
			'a' => 10,
			'b' => [
				'x' => 50,
				'y' => 60,
			],
		];

		$array2 = [
			'b' => [
				'x' => 5,
			],
			'a' => 1,
		];

		$result = Arr::intersect_key_recursive( $array1, $array2 );

		$this->assertSame([
			'a' => 10,
			'b' => [
				'x' => 50,
			]
		], $result );
	}

	public function test_with_all_common_keys_and_values(): void {
		$array1 = [
			'a' => 1,
			'b' => [
				'x' => 5,
				'y' => [
					'a' => 1,
				],
				'z' => 10,
			],
			'c' => 2,
			'd' => [],
		];

		$result = Arr::intersect_key_recursive( $array1, $array1 );

		$this->assertSame( $array1, $result );
	}

	public function test_with_multiple_arrays(): void {
		$array1 = [
			'a' => 1,
			'b' => 2,
			'c' => 3,
		];

		$array2 = [
			'a' => 10,
			'b' => 20,
		];

		$array3 = [
			'a' => 100,
			'c' => 300,
		];

		$result1 = Arr::intersect_key_recursive( $array1, $array2 );
		$result2 = Arr::intersect_key_recursive( $result1, $array3 );

		$this->assertEquals( [
			'a' => 1,
		], $result2 );
	}
}
