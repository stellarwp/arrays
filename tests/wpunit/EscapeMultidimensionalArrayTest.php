<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;
use stdClass;

final class EscapeMultidimensionalArrayTest extends ArraysTestCase {

	public function escape_multidimensional_array_data_provider() {
		return [
			'non_array_input' => [
				'input' => 'string',
				'expected' => []
			],
			'empty_array' => [
				'input' => [],
				'expected' => []
			],
			'simple_array' => [
				'input' => [
					'name' => 'John & Jane',
					'email' => 'test@test.com'
				],
				'expected' => [
					'name' => 'John &amp; Jane',
					'email' => 'test@test.com'
				]
			],
			'array_with_html' => [
				'input' => [
					'title' => '<h1>Title</h1>',
					'content' => '<p>Some content & stuff</p>'
				],
				'expected' => [
					'title' => '&lt;h1&gt;Title&lt;/h1&gt;',
					'content' => '&lt;p&gt;Some content &amp; stuff&lt;/p&gt;'
				]
			],
			'nested_array' => [
				'input' => [
					'user' => [
						'name' => 'John & Jane',
						'html' => '<p>Bio</p>'
					],
					'meta' => [
						'description' => 'User & profile'
					]
				],
				'expected' => [
					'user' => [
						'name' => 'John &amp; Jane',
						'html' => '&lt;p&gt;Bio&lt;/p&gt;'
					],
					'meta' => [
						'description' => 'User &amp; profile'
					]
				]
			],
			'array_with_objects' => [
				'input' => [
					'scalar' => 'Test & text',
					'object' => new stdClass(),
					'nested' => [
						'object' => new stdClass(),
						'text' => '<p>Text</p>'
					]
				],
				'expected' => [
					'scalar' => 'Test &amp; text',
					'object' => new stdClass(),
					'nested' => [
						'object' => new stdClass(),
						'text' => '&lt;p&gt;Text&lt;/p&gt;'
					]
				]
			],
			'array_with_whitespace' => [
				'input' => [
					'text' => '  Spaces & tabs  ',
					'nested' => [
						'content' => ' <p>Padded content</p> '
					]
				],
				'expected' => [
					'text' => 'Spaces &amp; tabs',
					'nested' => [
						'content' => '&lt;p&gt;Padded content&lt;/p&gt;'
					]
				]
			],
			'deep_nested_structure' => [
				'input' => [
					'level1' => [
						'level2' => [
							'level3' => [
								'text' => 'Deep & nested',
								'html' => '<span>HTML</span>'
							]
						]
					]
				],
				'expected' => [
					'level1' => [
						'level2' => [
							'level3' => [
								'text' => 'Deep &amp; nested',
								'html' => '&lt;span&gt;HTML&lt;/span&gt;'
							]
						]
					]
				]
			],
			'array_with_empty_values' => [
				'input' => [
					'empty' => '',
					'null' => null,
					'nested' => [
						'empty' => '',
						'text' => 'Some & text'
					]
				],
				'expected' => [
					'empty' => '',
					'null' => '',
					'nested' => [
						'empty' => '',
						'text' => 'Some &amp; text'
					]
				]
			]
		];
	}

	/**
	 * @dataProvider escape_multidimensional_array_data_provider
	 */
	public function test_escape_multidimensional_array($input, $expected) {
		$this->assertEquals($expected, Arr::escape_multidimensional_array($input));
	}
}
