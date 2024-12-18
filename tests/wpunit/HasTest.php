<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class HasTest extends ArraysTestCase {

	public function test_has() {
		$array = [ 'foo' => 'bar' ];
		$this->assertTrue(Arr::has($array, 'foo'));
		$this->assertFalse(Arr::has($array, 'bar'));

		$array = [ 'foo' => [ 'bar' => 'baz' ] ];
		$this->assertTrue(Arr::has($array, 'foo.bar'));
		$this->assertFalse(Arr::has($array, 'foo.baz'));

		$array = [ 'foo.bar' => 'baz' ];
		$this->assertTrue(Arr::has($array, 'foo.bar'));
	}
}
