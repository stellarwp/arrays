<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class ToListTest extends ArraysTestCase {
	public function test_to_list_with_array() {
		$array = ['apple', 'banana', 'orange'];
		$expected = 'apple,banana,orange';

		$result = Arr::to_list($array);

		$this->assertSame($expected, $result);
	}

	public function test_to_list_with_custom_separator() {
		$array = ['apple', 'banana', 'orange'];
		$expected = 'apple|banana|orange';

		$result = Arr::to_list($array, '|');

		$this->assertSame($expected, $result);
	}

	public function test_to_list_with_empty_array() {
		$array = [];

		$result = Arr::to_list($array);

		$this->assertSame('', $result);
	}

	public function test_to_list_with_string() {
		$string = 'already,a,list';

		$result = Arr::to_list($string);

		$this->assertSame($string, $result);
	}

	public function test_to_list_with_numeric_array() {
		$array = [1, 2, 3, 4, 5];
		$expected = '1,2,3,4,5';

		$result = Arr::to_list($array);

		$this->assertSame($expected, $result);
	}

	public function test_to_list_with_mixed_types() {
		$array = ['string', 123, true, 45.6];
		$expected = 'string,123,1,45.6';

		$result = Arr::to_list($array);

		$this->assertSame($expected, $result);
	}

	public function test_to_list_with_null() {
		$result = Arr::to_list(null);

		$this->assertEquals('', $result);
	}

	public function test_to_list_with_empty_string() {
		$string = '';

		$result = Arr::to_list($string);

		$this->assertSame('', $result);
	}
}
