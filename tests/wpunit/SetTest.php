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
}
