<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class QueryTest extends ArraysTestCase {
	public function test_simple_query_string() {
		$array = ['name' => 'John', 'age' => 30];
		$expected = 'name=John&age=30';

		$this->assertSame($expected, Arr::query($array));
	}

	public function test_query_with_spaces() {
		$array = ['name' => 'John Doe', 'location' => 'New York'];
		$expected = 'name=John%20Doe&location=New%20York';

		$this->assertSame($expected, Arr::query($array));
	}

	public function test_query_with_special_characters() {
		$array = ['email' => 'john+doe@example.com', 'tag' => '#awesome'];
		$expected = 'email=john%2Bdoe%40example.com&tag=%23awesome';

		$this->assertSame($expected, Arr::query($array));
	}

	public function test_query_with_array_values() {
		$array = [
			'colors' => ['red', 'blue'],
			'sizes' => ['S', 'M', 'L']
		];
		$expected = 'colors%5B0%5D=red&colors%5B1%5D=blue&sizes%5B0%5D=S&sizes%5B1%5D=M&sizes%5B2%5D=L';

		$this->assertSame($expected, Arr::query($array));
	}

	public function test_query_with_nested_arrays() {
		$array = [
			'user' => [
				'name' => 'John',
				'address' => [
					'city' => 'New York',
					'zip' => '10001'
				]
			]
		];
		$expected = 'user%5Bname%5D=John&user%5Baddress%5D%5Bcity%5D=New%20York&user%5Baddress%5D%5Bzip%5D=10001';

		$this->assertSame($expected, Arr::query($array));
	}

	public function test_query_with_null_values() {
		$array = ['name' => 'John', 'email' => null];
		$expected = 'name=John';

		$this->assertSame($expected, Arr::query($array));
	}

	public function test_query_with_boolean_values() {
		$array = ['active' => true, 'deleted' => false];
		$expected = 'active=1&deleted=0';

		$this->assertSame($expected, Arr::query($array));
	}

	public function test_query_with_numeric_values() {
		$array = ['id' => 123, 'price' => 99.99];
		$expected = 'id=123&price=99.99';

		$this->assertSame($expected, Arr::query($array));
	}

	public function test_empty_array() {
		$array = [];
		$expected = '';

		$this->assertSame($expected, Arr::query($array));
	}

	public function test_query_with_empty_string_values() {
		$array = ['name' => '', 'email' => 'test@example.com'];
		$expected = 'name=&email=test%40example.com';

		$this->assertSame($expected, Arr::query($array));
	}
}
