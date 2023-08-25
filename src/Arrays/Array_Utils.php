<?php

namespace StellarWP\Arrays;

/**
 * Array utilities
 */
class Array_Utils {

	/**
	 * Duplicates any key not prefixed with '_' creating a prefixed duplicate one.
	 *
	 * The prefixing and duplication is recursive.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $array     The array whose keys should be duplicated.
	 * @param bool  $recursive Whether the prefixing and duplication should be
	 *                         recursive or shallow.
	 *
	 * @return array|mixed The array with the duplicate, prefixed, keys or the
	 *               original input if not an array.
	 */
	public static function add_prefixed_keys_to( $array, bool $recursive = false ) {
		if ( ! is_array( $array ) ) {
			return $array;
		}

		$prefixed = [];
		foreach ( $array as $key => $value ) {
			if ( $recursive && is_array( $value ) ) {
				$value = self::add_prefixed_keys_to( $value, true );
				// And also add it to the original array.
				$array[ $key ] = array_merge( $array[ $key ], $value );
			}

			if ( 0 === strpos( $key, '_' ) ) {
				continue;
			}

			$prefixed[ '_' . $key ] = $value;
		}

		return array_merge( $array, $prefixed );
	}

	/**
	 * Duplicates any key prefixed with '_' creating an un-prefixed duplicate one.
	 *
	 * The un-prefixing and duplication is recursive.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $array     The array whose keys should be duplicated.
	 * @param bool  $recursive Whether the un-prefixing and duplication should be
	 *                         recursive or shallow.
	 *
	 * @return mixed|array The array with the duplicate, unprefixed, keys or the
	 *               original input if not an array.
	 */
	public static function add_unprefixed_keys_to( $array, bool $recursive = false ) {
		if ( ! is_array( $array ) ) {
			return $array;
		}

		$unprefixed = [];
		foreach ( $array as $key => $value ) {
			if ( $recursive && is_array( $value ) ) {
				$value = self::add_unprefixed_keys_to( $value, true );
				// And also add it to the original array.
				$array[ $key ] = array_merge( $array[ $key ], $value );
			}

			if ( 0 !== strpos( $key, '_' ) ) {
				continue;
			}
			$unprefixed[ substr( $key, 1 ) ] = $value;
		}

		return array_merge( $array, $unprefixed );
	}

	/**
	 * Recursively visits all elements of an array applying the specified callback to each element
	 * key and value.
	 *
	 * @since 1.0.0
	 *
	 * @param array|mixed $input   The input array whose nodes should be visited.
	 * @param callable    $visitor A callback function that will be called on each array item; the callback will
	 *                             receive the item key and value as input and should return an array that contains
	 *                             the update key and value in the shape `[ <key>, <value> ]`. Returning a `null`
	 *                             key will cause the element to be removed from the array.
	 */
	public static function array_visit_recursive( $input, callable $visitor ) {
		if ( ! is_array( $input ) ) {
			return $input;
		}

		$return = [];

		foreach ( $input as $key => &$value ) {
			if ( is_array( $value ) ) {
				$value = static::array_visit_recursive( $value, $visitor );
			}
			// Ensure visitors can quickly return `null` to remove an element.
			[ $updated_key, $update_value ] = array_replace( [ $key, $value ], (array) $visitor( $key, $value ) );
			if ( false === $updated_key ) {
				// Visitor will be able to remove an element by returning a `false` key for it.
				continue;
			}
			if ( null === $updated_key ) {
				// Automatically assign the first available numeric index to the element.
				$return[] = $update_value;
			} else {
				$return[ $updated_key ] = $update_value;
			}
		}

		return $return;
	}

	/**
	 * The inverse of the `stringify_keys` method, it will restore numeric keys for previously
	 * stringified keys.
	 *
	 * @since 1.0.0
	 *
	 * @param array<int|string,mixed> $input  The input array whose stringified keys should be
	 *                                        destringified.
	 * @param string                  $prefix The prefix that should be used to target only specific string keys.
	 *
	 * @return array<int|string,mixed> The input array, its stringified keys destringified.
	 */
	public static function destringify_keys( array $input, string $prefix = 'sk_' ): array {
		$visitor = static function( $key, $value ) use ( $prefix ) {
			$destringified_key = 0 === self::strpos( $key, $prefix ) ? null : $key;

			return [ $destringified_key, $value ];
		};

		return static::array_visit_recursive( $input, $visitor );
	}

	/**
	 * Sanitize a multidimensional array.
	 *
	 * @link    https://gist.github.com/esthezia/5804445
	 * @since   1.0.0
	 *
	 * @param array|mixed $data The array to sanitize.
	 *
	 * @return array The sanitized array
	 *
	 */
	public static function escape_multidimensional_array( $data = [] ): array {

		if ( ! is_array( $data ) || ! count( $data ) ) {
			return [];
		}

		foreach ( $data as $key => $value ) {
			if ( ! is_array( $value ) && ! is_object( $value ) ) {
				$data[ $key ] = esc_attr( trim( $value ) );
			}
			if ( is_array( $value ) ) {
				$data[ $key ] = self::escape_multidimensional_array( $value );
			}
		}

		return $data;
	}

	/**
	 * Discards everything other than array values having string keys and scalar values, ensuring a
	 * one-dimensional, associative array result.
	 *
	 * @link  https://www.php.net/manual/language.types.array.php Keys cast to non-strings will be discarded.
	 *
	 * @since 1.0.0
	 *
	 * @param array|mixed $array
	 *
	 * @return array|mixed Associative or empty array.
	 */
	public static function filter_to_flat_scalar_associative_array( $array ) {
		$result = [];

		if ( ! is_array( $array ) ) {
			return $result;
		}

		foreach ( $array as $k => $v ) {
			if ( ! is_string( $k ) ) {
				continue;
			}

			if ( ! is_scalar( $v ) ) {
				continue;
			}

			$result[ $k ] = $v;
		}

		return $result;
	}

	/**
	 * Filters an associative array non-recursively, keeping only the values attached
	 * to keys starting with the specified prefix.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $array  The array to filter.
	 * @param string $prefix The prefix, or prefixes, of the keys to keep.
	 *
	 * @return array The filtered array.
	 */
	public static function filter_prefixed( array $array, string $prefix ): array {
		$prefixes = implode( '|', array_map( 'preg_quote', (array) $prefix ) );
		$pattern  = '/^(' . $prefixes . ')/';
		$filtered = [];
		foreach ( $array as $key => $value ) {
			if ( ! preg_match( $pattern, $key ) ) {
				continue;
			}
			$filtered[ $key ] = $value;
		}

		return $filtered;
	}

	/**
	 * Flattens an array transforming each value that is an array and only contains one
	 * element into that one element.
	 *
	 * Typical use case is to flatten arrays like those returned by `get_post_meta( $id )`.
	 * Empty arrays are replaced with an empty string.
	 *
	 * @since 1.0.0
	 *
	 * @param array $array The array to flatten.
	 *
	 * @return array The flattened array.
	 */
	public static function flatten( array $array ): array {
		foreach ( $array as $key => &$value ) {
			if ( ! is_array( $value ) ) {
				continue;
			}

			$count = count( $value );

			switch ( $count ) {
				case 0:
					$value = '';
					break;
				case 1:
					$value = reset( $value );
					break;
				default:
					break;
			}
		}

		return $array;
	}

	/**
	 * Find a value inside of an array or object, including one nested a few levels deep.
	 *
	 * Example: get( $a, [ 0, 1, 2 ] ) returns the value of $a[0][1][2] or the default.
	 *
	 * @param array|object|mixed $variable Array or object to search within.
	 * @param array|string       $indexes  Specify each nested index in order.
	 *                                     Example: array( 'lvl1', 'lvl2' );
	 * @param mixed              $default  Default value if the search finds nothing.
	 *
	 * @return mixed The value of the specified index or the default if not found.
	 */
	public static function get( $variable, $indexes, $default = null ) {
		if ( is_object( $variable ) ) {
			$variable = (array) $variable;
		}

		if ( ! is_array( $variable ) ) {
			return $default;
		}

		foreach ( (array) $indexes as $index ) {
			if ( ! is_array( $variable ) || ! isset( $variable[ $index ] ) ) {
				$variable = $default;
				break;
			}

			$variable = $variable[ $index ];
		}

		return $variable;
	}

	/**
	 * Returns the value associated with the first index, among the indexes, that is set in the array..
	 *
	 * @since 1.0.0
	 *
	 * @param array $array   The array to search.
	 * @param array $indexes The indexes to search; in order the function will look from the first to the last.
	 * @param mixed $default The value that will be returned if the array does not have any of the indexes set.
	 *
	 * @return mixed|null The set value or the default value.
	 */
	public static function get_first_set( array $array, array $indexes, $default = null ) {
		foreach ( $indexes as $index ) {
			if ( ! isset( $array[ $index ] ) ) {
				continue;
			}

			return $array[ $index ];
		}

		return $default;
	}

	/**
	 * Find a value inside a list of array or objects, including one nested a few levels deep.
	 *
	 * @since 1.0.0
	 *
	 * Example: get( [$a, $b, $c], [ 0, 1, 2 ] ) returns the value of $a[0][1][2] found in $a, $b or $c
	 * or the default.
	 *
	 * @param array        $variables  Array of arrays or objects to search within.
	 * @param array|string $indexes    Specify each nested index in order.
	 *                                 Example: array( 'lvl1', 'lvl2' );
	 * @param mixed        $default    Default value if the search finds nothing.
	 *
	 * @return mixed The value of the specified index or the default if not found.
	 */
	public static function get_in_any( array $variables, $indexes, $default = null ) {
		foreach ( $variables as $variable ) {
			$found = self::get( $variable, $indexes, '__not_found__' );
			if ( '__not_found__' !== $found ) {
				return $found;
			}
		}

		return $default;
	}

	/**
	 * Insert an array after a specified key within another array.
	 *
	 * @param string|int $key The key of the array to insert after.
	 * @param array $source_array The array to insert into.
	 * @param mixed $insert Value or array to insert.
	 *
	 * @return array
	 */
	public static function insert_after_key( $key, array $source_array, $insert ): array {
		if ( ! is_array( $insert ) ) {
			$insert = [ $insert ];
		}

		if ( array_key_exists( $key, $source_array ) ) {
			$position     = array_search( $key, array_keys( $source_array ) ) + 1;
			$source_array = array_slice( $source_array, 0, $position, true ) + $insert + array_slice( $source_array, $position, null, true );
		} else {
			// If no key is found, then add it to the end of the array.
			$source_array += $insert;
		}

		return $source_array;
	}

	/**
	 * Insert an array immediately before a specified key within another array.
	 *
	 * @param string|int $key The key of the array to insert before.
	 * @param array $source_array The array to insert into.
	 * @param mixed $insert Value or array to insert.
	 *
	 * @return array
	 */
	public static function insert_before_key( $key, array $source_array, $insert ): array {
		if ( ! is_array( $insert ) ) {
			$insert = [ $insert ];
		}

		if ( array_key_exists( $key, $source_array ) ) {
			$position     = array_search( $key, array_keys( $source_array ) );
			$source_array = array_slice( $source_array, 0, $position, true ) + $insert + array_slice( $source_array, $position, null, true );
		} else {
			// If no key is found, then add it to the end of the array.
			$source_array += $insert;
		}

		return $source_array;
	}

	/**
	 * Converts a list to an array filtering out empty string elements.
	 *
	 * @param string|mixed|null $value A string representing a list of values separated by the specified separator
	 *                                 or an array. If the list is a string (e.g. a CSV list) then it will urldecoded
	 *                                 before processing.
	 * @param string|mixed      $sep   The char(s) separating the list elements; will be ignored if the list is an array.
	 *
	 * @return array An array of list elements.
	 */
	public static function list_to_array( $value, $sep = ',' ): array {
		// Let's not jump through all the hoops if the value is empty.
		if ( empty( $value ) ) {
			return [];
		}
		// since we might receive URL encoded strings for CSV lists let's URL decode them first
		$value = is_array( $value ) ? $value : urldecode( $value );

		$sep = ! is_string( $sep ) ? ',' : $sep;

		if ( $value === '' ) {
			return [];
		}

		if ( ! is_array( $value ) ) {
			$value = preg_split( '/\\s*' . preg_quote( $sep ) . '\\s*/', $value );
		}

		$filtered = [];
		foreach ( $value as $v ) {
			if ( '' === $v ) {
				continue;
			}
			$filtered[] = is_numeric( $v ) ? $v + 0 : $v;
		}

		return $filtered;
	}

	/**
	 * Returns an array of values obtained by using the keys on the map; keys
	 * that do not have a match in map are discarded.
	 *
	 * To discriminate from not found results and legitimately `false`
	 * values from the map the `$found` parameter will be set by reference.
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $keys       One or more keys that should be used to get
	 *                                 the new values
	 * @param array        $map        An associative array relating the keys to the new
	 *                                 values.
	 * @param bool         $found      When using a single key this argument will be
	 *                                 set to indicate whether the mapping was successful
	 *                                 or not.
	 *
	 * @return array|mixed|false An array of mapped values, a single mapped value when passing
	 *                           one key only or `false` if one key was passed but the key could
	 *                           not be mapped.
	 */
	public static function map_or_discard( $keys, array $map, bool &$found = true ) {
		$hash   = md5( (string) time() );
		$mapped = [];

		foreach ( (array) $keys as $key ) {
			$meta_key = self::get( $map, $key, $hash );
			if ( $hash === $meta_key ) {
				continue;
			}
			$mapped[] = $meta_key;
		}

		$found = (bool) count( $mapped );

		if ( is_array( $keys ) ) {
			return $mapped;
		}

		return $found ? $mapped[0] : false;
	}

	/**
	 * Recursively merge two arrays preserving keys.
	 *
	 * @since 1.0.0
	 *
	 * @link http://php.net/manual/en/function.array-merge-recursive.php#92195
	 *
	 * @param array $array1
	 * @param array $array2
	 *
	 * @return array
	 */
	function merge_recursive( array &$array1, array &$array2 ): array {
		$merged = $array1;

		foreach ( $array2 as $key => &$value ) {
			if ( is_array( $value ) && isset( $merged [ $key ] ) && is_array( $merged [ $key ] ) ) {
				$merged [ $key ] = static::merge_recursive( $merged [ $key ], $value );
			} else {
				$merged [ $key ] = $value;
			}
		}

		return $merged;
	}

	/**
	 * Merges two or more arrays in the nested format used by WP_Query arguments preserving and merging them correctly.
	 *
	 * The method will recursively replace named keys and merge numeric keys. The method takes its name from its intended
	 * primary use, but it's not limited to query arguments only.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string|int,mixed> ...$arrays A set of arrays to merge.
	 *
	 * @return array<string|int,mixed> The recursively merged array.
	 */
	public static function merge_recursive_query_vars( array ...$arrays ): array {
		if ( ! count( $arrays ) ) {
			return [];
		}

		// Temporarily transform numeric keys to string keys generated with time-related randomness.
		$stringified = array_map( [ static::class, 'stringify_keys' ], $arrays );
		// Replace recursive will recursively replace any entry that has the same string key, stringified keys will never match due to randomness.
		$merged = array_replace_recursive( ...$stringified );

		// Finally destringify the keys to return something that will resemble, in shape, the original arrays.
		return static::destringify_keys( $merged );
	}

	/**
	 * Build an array from migrating aliased key values to their canonical key values, removing all alias keys.
	 *
	 * If the original array has values for both the alias and its canonical, keep the canonical's value and
	 * discard the alias' value.
	 *
	 * @since 1.0.0
	 *
	 * @param array $original  An associative array of values, such as passed shortcode arguments.
	 * @param array $alias_map An associative array of aliases: key as alias, value as mapped canonical.
	 *                         Example: [ 'alias' => 'canonical', 'from' => 'to', 'that' => 'becomes_this' ]
	 *
	 * @return array
	 */
	public static function parse_associative_array_alias( array $original, array $alias_map ): array {
		// Ensure array values.
		$alias_map = static::filter_to_flat_scalar_associative_array( $alias_map );

		// Fail gracefully if alias array wasn't setup as [ 'from' => 'to' ].
		if ( empty( $alias_map ) ) {
			return $original;
		}

		$result = $original;

		// Parse aliases.
		foreach ( $alias_map as $from => $to ) {
			// If this alias isn't in use, go onto the next.
			if ( ! isset( $result[ $from ] ) ) {
				continue;
			}

			// Only allow setting alias value if canonical value is not already present.
			if ( ! isset( $result[ $to ] ) ) {
				$result[ $to ] = $result[ $from ];
			}

			// Always remove the alias key.
			unset( $result[ $from ] );
		}

		return $result;
	}

	/**
	 * Recursively key-sort an array.
	 *
	 * @since 1.0.0
	 *
	 * @param array $array The array to sort, modified by reference.
	 *
	 * @return bool The sorting result.
	 */
	public static function recursive_ksort( array &$array ): bool {
		foreach ( $array as &$value ) {
			if ( is_array( $value ) ) {
				static::recursive_ksort( $value );
			}
		}

		return ksort( $array );
	}

	/**
	 * Recursively remove associative, non numeric, keys from an array.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string|int,mixed> $input The input array.
	 *
	 * @return array<int|mixed> An array that only contains integer keys at any of its levels.
	 */
	public static function remove_numeric_keys_recursive( array $input ): array {
		return self::array_visit_recursive(
			$input,
			static function( $key ) {
				return is_numeric( $key ) ? false : $key;
			}
		);
	}

	/**
	 * Recursively remove numeric keys from an array.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string|int,mixed> $input The input array.
	 *
	 * @return array<string,mixed> An array that only contains non numeric keys at any of its levels.
	 */
	public static function remove_string_keys_recursive( array $input ): array {
		return self::array_visit_recursive(
			$input,
			static function( $key ) {
				return ! is_numeric( $key ) ? false : $key;
			}
		);
	}

	/**
	 * Set key/value within an array, can set a key nested inside of a multidimensional array.
	 *
	 * Example: set( $a, [ 0, 1, 2 ], 'hi' ) sets $a[0][1][2] = 'hi' and returns $a.
	 *
	 * @param mixed        $array  The array containing the key this sets.
	 * @param string|array $key    To set a key nested multiple levels deep pass an array
	 *                             specifying each key in order as a value.
	 *                             Example: array( 'lvl1', 'lvl2', 'lvl3' );
	 * @param mixed        $value  The value.
	 *
	 * @return array Full array with the key set to the specified value.
	 */
	public static function set( $array, $key, $value ): array {
		// Convert strings and such to array.
		$key = (array) $key;

		// Setup a pointer that we can point to the key specified.
		$key_pointer = &$array;

		// Iterate through every key, setting the pointer one level deeper each time.
		foreach ( $key as $i ) {

			// Ensure current array depth can have children set.
			if ( ! is_array( $key_pointer ) ) {
				// $key_pointer is set but is not an array. Converting it to an array
				// would likely lead to unexpected problems for whatever first set it.
				$error = sprintf(
					'Attempted to set $array[%1$s] but %2$s is already set and is not an array.',
					implode( '][', $key ),
					$i
				);

				_doing_it_wrong( __FUNCTION__, esc_html( $error ), '4.3' );
				break;
			} elseif ( ! isset( $key_pointer[ $i ] ) ) {
				$key_pointer[ $i ] = [];
			}

			// Dive one level deeper into the nested array.
			$key_pointer = &$key_pointer[ $i ];
		}

		// Set the value for the specified key
		$key_pointer = $value;

		return $array;
	}

	/**
	 * Shapes, filtering it, an array to the specified expected set of required keys.
	 *
	 * @since 1.0.0
	 *
	 * @param array $array The input array to shape.
	 * @param array $shape The shape to update the array with. It should only define keys
	 *                     or arrays of keys. Keys that have no values will be set to `null`.
	 *                     To add the key only if set, prefix the key with `?`, e.g. `?foo`.
	 *
	 * @return array The input array shaped and ordered per the shape.
	 */
	public static function shape_filter( array $array, array $shape ): array {
		$shaped = [];
		foreach ( $shape as $shape_index => $shape_key ) {
			$optional = is_array( $shape_key ) ?
				strpos( $shape_index, '?' ) === 0
				: strpos( $shape_key, '?' ) === 0;

			if ( is_array( $shape_key ) ) {
				$shape_index = $optional ? substr( $shape_index, 1 ) : $shape_index;
				if ( $optional && ! isset( $array[ $shape_index ] ) ) {
					continue;
				}
				$shaped[ $shape_index ] = self::shape_filter( $array[ $shape_index ] ?? [], $shape_key );
			} else {
				$shape_key = $optional ? substr( $shape_key, 1 ) : $shape_key;
				if ( ! isset( $array[ $shape_key ] ) && $optional ) {
					continue;
				}
				$shaped[ $shape_key ] = $array[ $shape_key ] ?? null;
			}
		}

		return $shaped;
	}

	/**
	 * Stringifies the numeric keys of an array.
	 *
	 * @since 1.0.0
	 *
	 * @param array<int|string,mixed> $input  The input array whose keys should be stringified.
	 * @param string|null             $prefix The prefix that should be use to stringify the keys, if not provided
	 *                                        then it will be generated.
	 *
	 * @return array<string,mixed> The input array with each numeric key stringified.
	 */
	public static function stringify_keys( array $input, $prefix = null ): array {
		$prefix  = null === $prefix ? uniqid( 'sk_', true ) : $prefix;
		$visitor = static function( $key, $value ) use ( $prefix ) {
			$string_key = is_numeric( $key ) ? $prefix . $key : $key;

			return [ $string_key, $value ];
		};

		return static::array_visit_recursive( $input, $visitor );
	}

	/**
	 * Behaves exactly like the native strpos(), but accepts an array of needles.
	 *
	 * @see strpos()
	 *
	 * @param string       $haystack String to search in.
	 * @param array|string $needles  Strings to search for.
	 * @param int          $offset   Starting position of search.
	 *
	 * @return false|int Integer position of first needle occurrence.
	 */
	public static function strpos( string $haystack, $needles, int $offset = 0 ) {
		$needles = (array) $needles;

		foreach ( $needles as $i ) {
			$search = strpos( $haystack, $i, $offset );

			if ( false !== $search ) {
				return $search;
			}
		}

		return false;
	}

	/**
	 * Returns a list separated by the specified separator.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed  $list
	 * @param string $sep
	 *
	 * @return string The list separated by the specified separator or the original list if the list is empty.
	 */
	public static function to_list( $list, string $sep = ',' ): string {
		if ( empty( $list ) ) {
			return $list;
		}

		if ( is_array( $list ) ) {
			return implode( $sep, $list );
		}

		return $list;
	}

	/**
	 * Searches an array using a callback and returns the index of the first match.
	 *
	 * This method fills the gap left by the non-existence of an `array_usearch` function.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed    $needle   The element to search in the array.
	 * @param array    $haystack The array to search.
	 * @param callable $callback A callback function with signature `fn($needle, $value, $key) :bool`
	 *                           that will be used to find the first match of needle in haystack.
	 *
	 * @return string|int|false Either the index of the first match or `false` if no match was found.
	 */
	public static function usearch( $needle, array $haystack, callable $callback ) {
		foreach ( $haystack as $key => $value ) {
			if ( $callback( $needle, $value, $key ) ) {
				return $key;
			}
		}

		return false;
	}
}
