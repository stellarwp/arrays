<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class AddTest extends ArraysTestCase {

	public function test_add() {
		$array = [];
		$array = Arr::add($array, 'foo', 'bar');
		$this->assertTrue(Arr::has($array, 'foo'));
		$this->assertFalse(Arr::has($array, 'bar'));

		$array = [];
		$array = Arr::add($array, 'foo.bar', 'baz');
		$this->assertTrue(Arr::has($array, 'foo.bar'));
		$this->assertFalse(Arr::has($array, 'foo.baz'));
	}
}
