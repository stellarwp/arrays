<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class MergeRecursiveQueryVarsTest extends ArraysTestCase {

	public function merge_wp_query_vars_data_provider() {
		return [
			'no input arrays'                         => [
				'inputs'   => [],
				'expected' => [],
			],
			'meta_query with numeric keys'            => [
				'inputs'   => [
					[ 'p' => 23, 'name' => 'foo', 'meta_query' => [ [ 'key' => '_key_1', 'compare' => '>', 'value' => 23 ] ] ],
					[ 'p' => 89, 'meta_query' => [ 'relation' => 'OR', [ 'key' => '_key_1', 'compare' => '<', 'value' => 89 ] ] ],
					[ 'name' => 'lorem', 'meta_query' => [ [ 'key' => '_key_2', 'compare' => 'EXISTS', 'value' => 'n' ] ] ],
				],
				'expected' => [
					'p'          => 89,
					'name'       => 'lorem',
					'meta_query' => [
						[ 'key' => '_key_1', 'compare' => '>', 'value' => 23 ],
						'relation' => 'OR',
						[ 'key' => '_key_1', 'compare' => '<', 'value' => 89 ],
						[ 'key' => '_key_2', 'compare' => 'EXISTS', 'value' => 'n' ],
					],
				],
			],
			'meta_query with string and numeric keys' => [
				'inputs'   => [
					[ 'p' => 23, 'name' => 'foo', 'meta_query' => [ [ 'key' => 'karma', 'compare' => '>', 'value' => 23 ] ] ],
					[
						'p'          => 89,
						'meta_query' => [
							'karma' => [
								'karma_gt_10'  => [ 'key' => 'karma', 'compare' => '>', 'value' => 10 ],
								'relation'     => 'AND',
								'karma_lt_100' => [ 'key' => 'karma', 'compare' => '>', 'value' => 10 ],
							],
							[ 'key' => 'testability', 'value' => 'n', 'compare' => 'EXISTS' ]
						],
					],
					[ 'name' => 'lorem', 'meta_query' => [ [ 'key' => '_key_2', 'compare' => 'EXISTS', 'value' => 'n' ] ] ],
					[
						'meta_query' => [ [ 'key' => 'votes', 'compare' => '<=', 'value' => 89  ] ],
					],
					[
						'meta_query' => [
							'votes' => [
								'votes_gt_10'  => [ 'key'     => 'votes', 'compare' => '>', 'value'   => 10 ],
								'relation'     => 'OR',
								'votes_lt_200' => [ 'key'     => 'votes', 'compare' => '<', 'value'   => 200 ],
							],
						],
					],
				],
				'expected' => [
					'p'          => 89,
					'name'       => 'lorem',
					'meta_query' => [
						0       => [ 'key' => 'karma', 'compare' => '>', 'value' => 23, ],
						'karma' => [
							'karma_gt_10'  => [ 'key' => 'karma', 'compare' => '>', 'value' => 10, ],
							'relation'     => 'AND',
							'karma_lt_100' => [ 'key' => 'karma', 'compare' => '>', 'value' => 10, ],
						],
						1       => [ 'key' => 'testability', 'value' => 'n', 'compare' => 'EXISTS', ],
						2       => [ 'key' => '_key_2', 'compare' => 'EXISTS', 'value' => 'n', ],
						3       => [ 'key' => 'votes', 'compare' => '<=', 'value' => 89, ],
						'votes' => [
							'votes_gt_10'  => [ 'key' => 'votes', 'compare' => '>', 'value' => 10, ],
							'relation'     => 'OR',
							'votes_lt_200' => [ 'key' => 'votes', 'compare' => '<', 'value' => 200, ],
						],
					],
				],
			]
		];
	}

	/**
	 * @dataProvider merge_wp_query_vars_data_provider
	 */
	public function test_merge_wp_query_vars( array $inputs, array $expected ) {
		$merged = Arr::merge_recursive_query_vars( ...$inputs );
		$this->assertEquals( $expected, $merged );
	}
}
