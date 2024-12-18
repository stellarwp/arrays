<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class AccessibleTest extends ArraysTestCase {

	public function test_accessible() {
		$this->assertTrue(Arr::accessible([]));
		$this->assertTrue(Arr::accessible([ 'foo' => 'bar' ]));
		$this->assertTrue(Arr::accessible(new \ArrayObject([ 'foo' => 'bar' ])));
		$this->assertFalse(Arr::accessible('foo'));
		$this->assertFalse(Arr::accessible(23));
	}
}
