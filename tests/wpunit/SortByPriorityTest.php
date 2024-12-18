<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;
use stdClass;

class SortByPriorityTest extends ArraysTestCase {
	public function test_sort_by_priority_array() {
		$array = [
			['priority' => 20, 'name' => 'second'],
			['priority' => 10, 'name' => 'first'],
			['priority' => 30, 'name' => 'third']
		];

		$expected = [
			['priority' => 10, 'name' => 'first'],
			['priority' => 20, 'name' => 'second'],
			['priority' => 30, 'name' => 'third']
		];

		$result = Arr::sort_by_priority($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_by_priority_objects() {
		$first = new stdClass();
		$first->priority = 10;
		$first->name = 'first';

		$second = new stdClass();
		$second->priority = 20;
		$second->name = 'second';

		$third = new stdClass();
		$third->priority = 30;
		$third->name = 'third';

		$array = [$second, $first, $third];
		$expected = [$first, $second, $third];

		$result = Arr::sort_by_priority($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_by_priority_associative_array() {
		$array = [
			'b' => ['priority' => 20, 'name' => 'second'],
			'a' => ['priority' => 10, 'name' => 'first'],
			'c' => ['priority' => 30, 'name' => 'third']
		];

		$expected = [
			'a' => ['priority' => 10, 'name' => 'first'],
			'b' => ['priority' => 20, 'name' => 'second'],
			'c' => ['priority' => 30, 'name' => 'third']
		];

		$result = Arr::sort_by_priority($array);

		$this->assertSame($expected, $result);
	}

	public function test_sort_by_priority_equal_priorities() {
		$array = [
			['priority' => 10, 'name' => 'first'],
			['priority' => 10, 'name' => 'also first'],
			['priority' => 20, 'name' => 'second']
		];

		$result = Arr::sort_by_priority($array);

		// Check that items with equal priorities maintain their relative positions
		$this->assertEquals(10, $result[0]['priority']);
		$this->assertEquals(10, $result[1]['priority']);
		$this->assertEquals(20, $result[2]['priority']);
	}

	public function test_sort_by_priority_non_array() {
		$this->expectException(\InvalidArgumentException::class);
		$input = 'not an array';
		$result = Arr::sort_by_priority($input);

		$this->assertSame($input, $result);
	}

	public function test_sort_by_priority_empty_array() {
		$array = [];
		$result = Arr::sort_by_priority($array);

		$this->assertSame([], $result);
	}
}
