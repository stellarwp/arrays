<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class UndotTest extends ArraysTestCase {

	public function test_undot() {
		$array = [ 'foo' => 'bar' ];
		$this->assertTrue(Arr::has(Arr::undot($array), 'foo'));

		$array = [ 'foo.bar' => 'baz' ];
		$this->assertTrue(Arr::has(Arr::undot($array), 'foo.bar'));
	}
}
