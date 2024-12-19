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

	public function test_has_with_closure() {
		$array = [];
		$array = Arr::set($array, 'foo', function () {
			return 'bar';
		});

		$array = Arr::set($array, 'foo.bork', 'whee');

		// This set should override the closure.
		$array = Arr::set($array, 'foo.bar', function () {
			return 'baz';
		});

		$this->assertTrue(Arr::has($array, 'foo'));
		$this->assertTrue(Arr::has($array, 'foo.bar'));
		$this->assertTrue(Arr::has($array, 'foo.bork'));
	}
}
