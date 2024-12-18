<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class CollapseTest extends ArraysTestCase {

	public function collapse_data_provider() {
		return [
			'empty_array' => [
				'input' => [],
				'expected' => []
			],
			'array_with_non_array_values' => [
				'input' => ['foo', 23, null, true],
				'expected' => []
			],
			'array_with_single_array' => [
				'input' => [['foo', 'bar']],
				'expected' => ['foo', 'bar']
			],
			'array_with_multiple_arrays' => [
				'input' => [
					['foo', 'bar'],
					['baz', 'qux']
				],
				'expected' => ['foo', 'bar', 'baz', 'qux']
			],
			'array_with_mixed_values' => [
				'input' => [
					23,
					['foo', 'bar'],
					null,
					['baz', 'qux'],
					'string'
				],
				'expected' => ['foo', 'bar', 'baz', 'qux']
			],
			'array_with_associative_arrays' => [
				'input' => [
					['foo' => 'bar'],
					['baz' => 'qux']
				],
				'expected' => ['foo' => 'bar', 'baz' => 'qux']
			],
			'array_with_nested_arrays' => [
				'input' => [
					['foo' => ['nested' => 'value']],
					['bar' => ['other' => 'value']]
				],
				'expected' => [
					'foo' => ['nested' => 'value'],
					'bar' => ['other' => 'value']
				]
			],
			'array_with_duplicate_keys' => [
				'input' => [
					['foo' => 'bar'],
					['foo' => 'baz']
				],
				'expected' => ['foo' => 'baz']
			]
		];
	}

	/**
	 * @dataProvider collapse_data_provider
	 */
	public function test_collapse($input, $expected) {
		$this->assertEquals($expected, Arr::collapse($input));
	}
}
