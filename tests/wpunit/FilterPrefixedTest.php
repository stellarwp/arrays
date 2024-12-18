<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class FilterPrefixedTest extends ArraysTestCase {

	public function filter_prefixed_data_provider() {
		return [
			'empty_array' => [
				'array' => [],
				'prefix' => 'test_',
				'expected' => []
			],
			'no_matching_prefix' => [
				'array' => [
					'foo' => 'bar',
					'baz' => 'qux'
				],
				'prefix' => 'test_',
				'expected' => []
			],
			'single_prefix' => [
				'array' => [
					'test_foo' => 'bar',
					'baz' => 'qux',
					'test_other' => 'value'
				],
				'prefix' => 'test_',
				'expected' => [
					'test_foo' => 'bar',
					'test_other' => 'value'
				]
			],
			'prefix_with_special_chars' => [
				'array' => [
					'test.foo' => 'bar',
					'test*baz' => 'qux',
					'normal' => 'value'
				],
				'prefix' => 'test.',
				'expected' => [
					'test.foo' => 'bar',
				]
			],
			'case_sensitive_prefix' => [
				'array' => [
					'Test_foo' => 'bar',
					'test_baz' => 'qux',
					'TEST_other' => 'value'
				],
				'prefix' => 'test_',
				'expected' => [
					'test_baz' => 'qux'
				]
			],
			'empty_prefix' => [
				'array' => [
					'foo' => 'bar',
					'baz' => 'qux'
				],
				'prefix' => '',
				'expected' => [
					'foo' => 'bar',
					'baz' => 'qux'
				],
			],
			'nested_arrays_not_filtered' => [
				'array' => [
					'test_foo' => [
						'nested' => 'value',
						'test_nested' => 'other'
					],
					'normal' => [
						'test_inner' => 'value'
					]
				],
				'prefix' => 'test_',
				'expected' => [
					'test_foo' => [
						'nested' => 'value',
						'test_nested' => 'other'
					]
				]
			]
		];
	}

	/**
	 * @dataProvider filter_prefixed_data_provider
	 */
	public function test_filter_prefixed($array, $prefix, $expected) {
		$this->assertEquals($expected, Arr::filter_prefixed($array, $prefix));
	}
}
