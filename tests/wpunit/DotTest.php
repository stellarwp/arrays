<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

final class DotTest extends ArraysTestCase {

	public function test_dot() {
		$array = [ 'foo' => 'bar' ];
		$this->assertTrue(Arr::has(Arr::dot($array), 'foo'));

		$array = [ 'foo' => [ 'bar' => 'baz' ] ];
		$this->assertTrue(Arr::has(Arr::dot($array), 'foo.bar'));
	}
}
