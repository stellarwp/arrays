<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class PullTest extends ArraysTestCase {
	public function test_pull_simple_key() {
		$array = ['name' => 'John', 'age' => 30];
		$value = Arr::pull($array, 'name');

		$this->assertSame('John', $value);
		$this->assertSame(['age' => 30], $array);
	}

	public function test_pull_with_dot_notation() {
		$array = [
			'user' => [
				'profile' => [
					'name' => 'John',
					'age' => 30
				]
			]
		];
		$value = Arr::pull($array, 'user.profile.name');

		$this->assertSame('John', $value);
		$this->assertSame([
			'user' => [
				'profile' => [
					'age' => 30
				]
			]
		], $array);
	}

	public function test_pull_nonexistent_key() {
		$array = ['name' => 'John'];
		$value = Arr::pull($array, 'email', 'default@email.com');

		$this->assertSame('default@email.com', $value);
		$this->assertSame(['name' => 'John'], $array);
	}

	public function test_pull_numeric_key() {
		$array = [10 => 'ten', 20 => 'twenty'];
		$value = Arr::pull($array, 10);

		$this->assertSame('ten', $value);
		$this->assertSame([20 => 'twenty'], $array);
	}

	public function test_pull_with_null_value() {
		$array = ['name' => null, 'age' => 30];
		$value = Arr::pull($array, 'name', 'default');

		$this->assertSame('default', $value);
		$this->assertSame(['age' => 30], $array);
	}

	public function test_pull_nested_array() {
		$array = [
			'data' => [
				'users' => [
					['id' => 1, 'name' => 'John'],
					['id' => 2, 'name' => 'Jane']
				]
			]
		];
		$value = Arr::pull($array, 'data.users');

		$this->assertSame([
			['id' => 1, 'name' => 'John'],
			['id' => 2, 'name' => 'Jane']
		], $value);
		$this->assertSame(['data' => []], $array);
	}

	public function test_pull_with_empty_array() {
		$array = [];
		$value = Arr::pull($array, 'key', 'default');

		$this->assertSame('default', $value);
		$this->assertSame([], $array);
	}

	public function test_pull_with_deep_nonexistent_key() {
		$array = ['user' => ['name' => 'John']];
		$value = Arr::pull($array, 'user.profile.email', 'default@email.com');

		$this->assertSame('default@email.com', $value);
		$this->assertSame(['user' => ['name' => 'John']], $array);
	}

	public function test_pull_modifies_original_array() {
		$original = ['first' => 1, 'second' => 2];
		$array = $original;
		Arr::pull($array, 'first');

		$this->assertNotSame($original, $array);
		$this->assertSame(['second' => 2], $array);
	}
}
