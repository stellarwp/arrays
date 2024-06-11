<?php

use StellarWP\Arrays\Arr;
use StellarWP\Arrays\Tests\ArraysTestCase;

class UndotTest extends ArraysTestCase
{

    public function setUp()
    {
        // before
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function it_properly_expands_array()
    {
        $dotted = [
        'one.two.three.five.eight' => 'fibonacci',
        ];

        $expected = [
        'one' => [
        'two' => [
        'three' => [
        'five' => [
        'eight' => 'fibonacci'
        ]
        ]
        ]
        ],
        ];

        $this->assertSame($expected, Arr::undot($dotted));
    }

    /**
     * @test
     */
    public function it_expands_array_with_leaves()
    {
        $dotted = [
        'one.first_leaf' => true,
        'one.two.second_leaf' => true,
        'one.two.three.third_leaf' => true,
        'one.two.three.five.fifth_leaf' => true,
        'one.two.three.five.eight' => 'fibonacci',
        ];

        $expected = [
        'one' => [
        'first_leaf' => true,
        'two' => [
                    'second_leaf' => true,
                    'three' => [
                        'third_leaf' => true,
                        'five' => [
                            'fifth_leaf' => true,
                            'eight' => 'fibonacci'
                        ]
                    ]
        ]
        ],
        ];

        $this->assertSame($expected, Arr::undot($dotted));
    }

	 /**
     * @test
     */
    public function it_expands_nested_arrays_with_numerical_keys()
    {
        $dotted = [
			'first_array.0'  => 'bacon',
			'first_array.1'  => 'ham',
			'first_array.2'  => 'cheese',
			'second_array.0' => 'bacon',
			'second_array.1' => 'egg',
			'second_array.2' => 'cheese',
        ];

        $expected = [
			'first_array' => [
				'bacon',
				'ham',
				'cheese',
			],
			'second_array' => [
				'bacon',
				'egg',
				'cheese'
			]
		];

        $this->assertSame($expected, Arr::undot($dotted));
    }
}
