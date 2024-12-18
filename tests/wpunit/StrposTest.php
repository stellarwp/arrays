<?php
namespace StellarWP\Arrays;

use StellarWP\Arrays\Tests\ArraysTestCase;

class StrposTest extends ArraysTestCase {
	public function test_strpos_single_needle() {
		$haystack = 'The quick brown fox jumps over the lazy dog';
		$needle = 'fox';

		$result = Arr::strpos($haystack, $needle);

		$this->assertSame(16, $result);
	}

	public function test_strpos_multiple_needles() {
		$haystack = 'The quick brown fox jumps over the lazy dog';
		$needles = ['fox', 'dog', 'cat'];

		$result = Arr::strpos($haystack, $needles);

		// Should find 'fox' first at position 16
		$this->assertSame(16, $result);
	}

	public function test_strpos_with_offset() {
		$haystack = 'The quick brown fox jumps over the lazy fox';
		$needle = 'fox';

		$result = Arr::strpos($haystack, $needle, 20);

		// Should find the second 'fox' at position 40
		$this->assertSame(40, $result);
	}

	public function test_strpos_not_found() {
		$haystack = 'The quick brown fox jumps over the lazy dog';
		$needles = ['cat', 'bird', 'fish'];

		$result = Arr::strpos($haystack, $needles);

		$this->assertFalse($result);
	}

	public function test_strpos_empty_needle() {
		$haystack = 'The quick brown fox jumps over the lazy dog';
		$needle = '';

		$result = Arr::strpos($haystack, $needle);

		$this->assertFalse($result);
	}

	public function test_strpos_empty_haystack() {
		$haystack = '';
		$needles = ['fox', 'dog'];

		$result = Arr::strpos($haystack, $needles);

		$this->assertFalse($result);
	}

	public function test_strpos_case_sensitive() {
		$haystack = 'The quick brown Fox jumps over the lazy dog';
		$needles = ['fox', 'FOX', 'Fox'];

		$result = Arr::strpos($haystack, $needles);

		// Should only find 'Fox' at position 16
		$this->assertSame(16, $result);
	}

	public function test_strpos_multiple_matches_returns_first() {
		$haystack = 'The quick quick brown fox jumps over the quick dog';
		$needles = ['quick', 'fox', 'dog'];

		$result = Arr::strpos($haystack, $needles);

		// Should find first 'quick' at position 4
		$this->assertSame(4, $result);
	}
}
