<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class SetTest extends ArraysTestCase {

	public function test_set() {
		$array = [];
		$array = Arr::set($array, 'foo', 'bar');
		$this->assertTrue(Arr::has($array, 'foo'));
		$this->assertFalse(Arr::has($array, 'bar'));

		$array = [];
		$array = Arr::set($array, ['foo', 'bar'], 'baz');
		$this->assertTrue(Arr::has($array, 'foo.bar'));
		$this->assertFalse(Arr::has($array, 'foo.baz'));
	}

	public function test_set_with_closure() {
		$array = [];
		$array = Arr::set($array, 'foo', function () {
			return 'bar';
		});

		// This set should override the closure.
		$array = Arr::set($array, 'foo.bar', function () {
			return 'baz';
		});

		$this->assertTrue(Arr::has($array, 'foo'));
		$this->assertIsArray(Arr::get($array, 'foo'));
		$this->assertTrue(Arr::has($array, 'foo.bar'));
	}
}
