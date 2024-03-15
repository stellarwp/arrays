***

# Arr

Array utilities



* Full name: `\StellarWP\Arrays\Arr`




## Methods


### accessible

Determines if the given value is array accessible.

```php
public static accessible(mixed $value): bool
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$value` | **mixed** |  |




***

### add

Add an element to an array using "dot" notation if it doesn't exist.

```php
public static add(array $array, string|int|float $key, mixed $value): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$key` | **string&#124;int&#124;float** |  |
| `$value` | **mixed** |  |




***

### add_prefixed_keys_to

Duplicates any key not prefixed with '_' creating a prefixed duplicate one.

```php
public static add_prefixed_keys_to(mixed $array, bool $recursive = false): array|mixed
```

The prefixing and duplication is recursive.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **mixed** | The array whose keys should be duplicated. |
| `$recursive` | **bool** | Whether the prefixing and duplication should be<br />recursive or shallow. |


**Return Value:**

The array with the duplicate, prefixed, keys or the
original input if not an array.



***

### add_unprefixed_keys_to

Duplicates any key prefixed with '_' creating an un-prefixed duplicate one.

```php
public static add_unprefixed_keys_to(mixed $array, bool $recursive = false): mixed|array
```

The un-prefixing and duplication is recursive.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **mixed** | The array whose keys should be duplicated. |
| `$recursive` | **bool** | Whether the un-prefixing and duplication should be<br />recursive or shallow. |


**Return Value:**

The array with the duplicate, unprefixed, keys or the
original input if not an array.



***

### array_visit_recursive

Recursively visits all elements of an array applying the specified callback to each element
key and value.

```php
public static array_visit_recursive(array|mixed $input, callable $visitor): mixed
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$input` | **array&#124;mixed** | The input array whose nodes should be visited. |
| `$visitor` | **callable** | A callback function that will be called on each array item; the callback will<br />receive the item key and value as input and should return an array that contains<br />the update key and value in the shape `[ &lt;key&gt;, &lt;value&gt; ]`. Returning a `null`<br />key will cause the element to be removed from the array. |




***

### collapse

Collapse an array of arrays into a single array.

```php
public static collapse(iterable $array): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **iterable** |  |




***

### destringify_keys

The inverse of the `stringify_keys` method, it will restore numeric keys for previously
stringified keys.

```php
public static destringify_keys(array&lt;int|string,mixed&gt; $input, string $prefix = &#039;sk_&#039;): array&lt;int|string,mixed&gt;
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$input` | **array<int&#124;string,mixed>** | The input array whose stringified keys should be<br />destringified. |
| `$prefix` | **string** | The prefix that should be used to target only specific string keys. |


**Return Value:**

The input array, its stringified keys destringified.



***

### dot

Flatten a multi-dimensional associative array with dots.

```php
public static dot(iterable $array, string $prepend = &#039;&#039;): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **iterable** |  |
| `$prepend` | **string** |  |




***

### escape_multidimensional_array

Sanitize a multidimensional array.

```php
public static escape_multidimensional_array(array|mixed $data = []): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **array&#124;mixed** | The array to sanitize. |


**Return Value:**

The sanitized array


**See Also:**

* https://gist.github.com/esthezia/5804445 -

***

### filter_to_flat_scalar_associative_array

Discards everything other than array values having string keys and scalar values, ensuring a
one-dimensional, associative array result.

```php
public static filter_to_flat_scalar_associative_array(array|mixed $array): array|mixed
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array&#124;mixed** |  |


**Return Value:**

Associative or empty array.


**See Also:**

* https://www.php.net/manual/language.types.array.php - Keys cast to non-strings will be discarded.

***

### except

Get all of the given array except for a specified array of keys.

```php
public static except(array $array, array|string|int|float $keys): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$keys` | **array&#124;string&#124;int&#124;float** |  |




***

### exists

Determine if the given key exists in the provided array.

```php
public static exists(\ArrayAccess|array $array, string|int|float $key): bool
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **\ArrayAccess&#124;array** |  |
| `$key` | **string&#124;int&#124;float** |  |




***

### filter_prefixed

Filters an associative array non-recursively, keeping only the values attached
to keys starting with the specified prefix.

```php
public static filter_prefixed(array $array, string $prefix): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** | The array to filter. |
| `$prefix` | **string** | The prefix, or prefixes, of the keys to keep. |


**Return Value:**

The filtered array.



***

### first

Return the first element in an array passing a given truth test.

```php
public static first(iterable $array, callable|null $callback = null, mixed $default = null): mixed
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **iterable** |  |
| `$callback` | **callable&#124;null** |  |
| `$default` | **mixed** |  |




***

### flatten

Flatten a multi-dimensional array into a single level.

```php
public static flatten(iterable $array, int $depth = PHP_INT_MAX): array
```

Typical use case is to flatten arrays like those returned by `get_post_meta( $id )`.
Empty arrays are replaced with an empty string.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **iterable** |  |
| `$depth` | **int** |  |


**Return Value:**

The flattened array.



***

### forget

Remove one or many array items from a given array using "dot" notation.

```php
public static forget(array& $array, array|string|int|float $keys): void
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$keys` | **array&#124;string&#124;int&#124;float** |  |




***

### get

Find a value inside of an array or object, including one nested a few levels deep.

```php
public static get(array|object|mixed $variable, array|string|int|null $indexes, mixed $default = null): mixed
```

Example: get( $a, [ 0, 1, 2 ] ) returns the value of $a[0][1][2] or the default.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$variable` | **array&#124;object&#124;mixed** | Array or object to search within. |
| `$indexes` | **array&#124;string&#124;int&#124;null** | Specify each nested index in order.<br />Example: array( &#039;lvl1&#039;, &#039;lvl2&#039; ); |
| `$default` | **mixed** | Default value if the search finds nothing. |


**Return Value:**

The value of the specified index or the default if not found.



***

### get_first_set

Returns the value associated with the first index, among the indexes, that is set in the array.

```php
public static get_first_set(array $array, array $indexes, mixed $default = null): mixed|null
```

.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** | The array to search. |
| `$indexes` | **array** | The indexes to search; in order the function will look from the first to the last. |
| `$default` | **mixed** | The value that will be returned if the array does not have any of the indexes set. |


**Return Value:**

The set value or the default value.



***

### get_in_any

Find a value inside a list of array or objects, including one nested a few levels deep.

```php
public static get_in_any(array $variables, array|string $indexes, mixed $default = null): mixed
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$variables` | **array** | Array of arrays or objects to search within. |
| `$indexes` | **array&#124;string** | Specify each nested index in order.<br />Example: array( &#039;lvl1&#039;, &#039;lvl2&#039; ); |
| `$default` | **mixed** | Default value if the search finds nothing. |


**Return Value:**

The value of the specified index or the default if not found.



***

### has

Check if an item or items exist in an array using "dot" notation.

```php
public static has(\ArrayAccess|array $array, array|string|int|null $indexes): bool
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **\ArrayAccess&#124;array** |  |
| `$indexes` | **array&#124;string&#124;int&#124;null** | The indexes to search; in order the function will look from the first to the last. |


### has_shape

Check if an array has a specific shape.

```php
public static has_shape(mixed $array, array $shape): bool
```

* This method is **static**.




**Parameters:**

| Parameter | Type      | Description                                                                       |
|-----------|-----------|-----------------------------------------------------------------------------------|
| `$array`  | **mixed** | The array to check.                                                               |
| `$shape`  | **array** | The shape to check for. A map from keys to the callable or Closure to check them. |

***

### insert_after_key

Insert an array after a specified key within another array.

```php
public static insert_after_key(string|int $key, array $source_array, mixed $insert): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$key` | **string&#124;int** | The key of the array to insert after. |
| `$source_array` | **array** | The array to insert into. |
| `$insert` | **mixed** | Value or array to insert. |




***

### insert_before_key

Insert an array immediately before a specified key within another array.

```php
public static insert_before_key(string|int $key, array $source_array, mixed $insert): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$key` | **string&#124;int** | The key of the array to insert before. |
| `$source_array` | **array** | The array to insert into. |
| `$insert` | **mixed** | Value or array to insert. |




***

### is_assoc

Determines if an array is associative.

```php
public static is_assoc(array $array): bool
```

An array is "associative" if it doesn't have sequential numerical keys beginning with zero.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |




***

### is_list

Determines if an array is a list.

```php
public static is_list(array $array): bool
```

An array is a "list" if all array keys are sequential integers starting from 0 with no gaps in between.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |




***

### join

Join all items using a string. The final items can use a separate glue string.

```php
public static join(array $array, string $glue, string $finalGlue = &#039;&#039;): string
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$glue` | **string** |  |
| `$finalGlue` | **string** |  |




***

### last

Return the last element in an array passing a given truth test.

```php
public static last(array $array, callable|null $callback = null, mixed $default = null): mixed
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$callback` | **callable&#124;null** |  |
| `$default` | **mixed** |  |




***

### list_to_array

Converts a list to an array filtering out empty string elements.

```php
public static list_to_array(string|mixed|null $value, string|mixed $sep = &#039;,&#039;): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$value` | **string&#124;mixed&#124;null** | A string representing a list of values separated by the specified separator<br />or an array. If the list is a string (e.g. a CSV list) then it will urldecoded<br />before processing. |
| `$sep` | **string&#124;mixed** | The char(s) separating the list elements; will be ignored if the list is an array. |


**Return Value:**

An array of list elements.



***

### map_or_discard

Returns an array of values obtained by using the keys on the map; keys
that do not have a match in map are discarded.

```php
public static map_or_discard(string|array $keys, array $map, bool& $found = true): array|mixed|false
```

To discriminate from not found results and legitimately `false`
values from the map the `$found` parameter will be set by reference.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$keys` | **string&#124;array** | One or more keys that should be used to get<br />the new values |
| `$map` | **array** | An associative array relating the keys to the new<br />values. |
| `$found` | **bool** | When using a single key this argument will be<br />set to indicate whether the mapping was successful<br />or not. |


**Return Value:**

An array of mapped values, a single mapped value when passing
one key only or `false` if one key was passed but the key could
not be mapped.



***

### merge_recursive

Recursively merge two arrays preserving keys.

```php
public merge_recursive(array& $array1, array& $array2): array
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array1` | **array** |  |
| `$array2` | **array** |  |



**See Also:**

* http://php.net/manual/en/function.array-merge-recursive.php#92195 -

***

### merge_recursive_query_vars

Merges two or more arrays in the nested format used by WP_Query arguments preserving and merging them correctly.

```php
public static merge_recursive_query_vars(array&lt;string|int,mixed&gt; $arrays): array&lt;string|int,mixed&gt;
```

The method will recursively replace named keys and merge numeric keys. The method takes its name from its intended
primary use, but it's not limited to query arguments only.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$arrays` | **array<string&#124;int,mixed>** | A set of arrays to merge. |


**Return Value:**

The recursively merged array.



***

### only

Get a subset of the items from the given array.

```php
public static only(array $array, array|string $keys): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$keys` | **array&#124;string** |  |




***

### parse_associative_array_alias

Build an array from migrating aliased key values to their canonical key values, removing all alias keys.

```php
public static parse_associative_array_alias(array $original, array $alias_map): array
```

If the original array has values for both the alias and its canonical, keep the canonical's value and
discard the alias' value.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$original` | **array** | An associative array of values, such as passed shortcode arguments. |
| `$alias_map` | **array** | An associative array of aliases: key as alias, value as mapped canonical.<br />Example: [ &#039;alias&#039; =&gt; &#039;canonical&#039;, &#039;from&#039; =&gt; &#039;to&#039;, &#039;that&#039; =&gt; &#039;becomes_this&#039; ] |




***

### prepend

Push an item onto the beginning of an array.

```php
public static prepend(array $array, mixed $value, mixed $key = null): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$value` | **mixed** |  |
| `$key` | **mixed** |  |




***

### pull

Get a value from the array, and remove it.

```php
public static pull(array& $array, string|int $key, mixed $default = null): mixed
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$key` | **string&#124;int** |  |
| `$default` | **mixed** |  |




***

### query

Convert the array into a query string.

```php
public static query(array $array): string
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |




***

### random

Get one or a specified number of random values from an array.

```php
public static random(array $array, int|null $number = null, bool $preserveKeys = false): mixed
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$number` | **int&#124;null** |  |
| `$preserveKeys` | **bool** |  |




***

### recursive_ksort

Recursively key-sort an array.

```php
public static recursive_ksort(array& $array): bool
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** | The array to sort, modified by reference. |


**Return Value:**

The sorting result.



***

### remove_numeric_keys_recursive

Recursively remove associative, non numeric, keys from an array.

```php
public static remove_numeric_keys_recursive(array&lt;string|int,mixed&gt; $input): (int|mixed)[]
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$input` | **array<string&#124;int,mixed>** | The input array. |


**Return Value:**

An array that only contains integer keys at any of its levels.



***

### remove_string_keys_recursive

Recursively remove numeric keys from an array.

```php
public static remove_string_keys_recursive(array&lt;string|int,mixed&gt; $input): array&lt;string,mixed&gt;
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$input` | **array<string&#124;int,mixed>** | The input array. |


**Return Value:**

An array that only contains non numeric keys at any of its levels.



***

### set

Set key/value within an array, can set a key nested inside of a multidimensional array.

```php
public static set(mixed $array, string|array $key, mixed $value): array
```

Example: set( $a, [ 0, 1, 2 ], 'hi' ) sets $a[0][1][2] = 'hi' and returns $a.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **mixed** | The array containing the key this sets. |
| `$key` | **string&#124;array** | To set a key nested multiple levels deep pass an array<br />specifying each key in order as a value.<br />Example: array( &#039;lvl1&#039;, &#039;lvl2&#039;, &#039;lvl3&#039; ); |
| `$value` | **mixed** | The value. |


**Return Value:**

Full array with the key set to the specified value.



***

### shape_filter

Shapes, filtering it, an array to the specified expected set of required keys.

```php
public static shape_filter(array $array, array $shape): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** | The input array to shape. |
| `$shape` | **array** | The shape to update the array with. It should only define keys<br />or arrays of keys. Keys that have no values will be set to `null`.<br />To add the key only if set, prefix the key with `?`, e.g. `?foo`. |


**Return Value:**

The input array shaped and ordered per the shape.



***

### shuffle

Shuffle the given array and return the result.

```php
public static shuffle(array $array, int|null $seed = null): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$seed` | **int&#124;null** |  |




***

### sort_by_priority

Sort based on Priority

```php
public static sort_by_priority(array $array): int
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** | Array to sort. |




***

### sort_by_priority_comparison

Sort based on Priority

```php
protected static sort_by_priority_comparison(object|array $a, object|array $b): int
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$a` | **object&#124;array** | First Subject to compare |
| `$b` | **object&#124;array** | Second subject to compare |




***

### sort_recursive

Recursively sort an array by keys and values.

```php
public static sort_recursive(array $array, int $options = SORT_REGULAR, bool $descending = false): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$options` | **int** |  |
| `$descending` | **bool** |  |




***

### sort_recursive_desc

Recursively sort an array by keys and values in descending order.

```php
public static sort_recursive_desc(array $array, int $options = SORT_REGULAR): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$options` | **int** |  |




***

### stringify_keys

Stringifies the numeric keys of an array.

```php
public static stringify_keys(array&lt;int|string,mixed&gt; $input, string|null $prefix = null): array&lt;string,mixed&gt;
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$input` | **array<int&#124;string,mixed>** | The input array whose keys should be stringified. |
| `$prefix` | **string&#124;null** | The prefix that should be use to stringify the keys, if not provided<br />then it will be generated. |


**Return Value:**

The input array with each numeric key stringified.



***

### strpos

Behaves exactly like the native strpos(), but accepts an array of needles.

```php
public static strpos(string $haystack, array|string $needles, int $offset): false|int
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$haystack` | **string** | String to search in. |
| `$needles` | **array&#124;string** | Strings to search for. |
| `$offset` | **int** | Starting position of search. |


**Return Value:**

Integer position of first needle occurrence.


**See Also:**

* \StellarWP\Arrays\strpos() -

***

### to_list

Returns a list separated by the specified separator.

```php
public static to_list(mixed $list, string $sep = &#039;,&#039;): string
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$list` | **mixed** |  |
| `$sep` | **string** |  |


**Return Value:**

The list separated by the specified separator or the original list if the list is empty.



***

### undot

Convert a flatten "dot" notation array into an expanded array.

```php
public static undot(iterable $array): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **iterable** |  |




***

### usearch

Searches an array using a callback and returns the index of the first match.

```php
public static usearch(mixed $needle, array $haystack, callable $callback): string|int|false
```

This method fills the gap left by the non-existence of an `array_usearch` function.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$needle` | **mixed** | The element to search in the array. |
| `$haystack` | **array** | The array to search. |
| `$callback` | **callable** | A callback function with signature `fn($needle, $value, $key) :bool`<br />that will be used to find the first match of needle in haystack. |


**Return Value:**

Either the index of the first match or `false` if no match was found.



***

### where

Filter the array using the given callback.

```php
public static where(array $array, callable $callback): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |
| `$callback` | **callable** |  |




***

### where_not_null

Filter items where the value is not null.

```php
public static where_not_null(array $array): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** |  |




***

### wrap

If the given value is not an array and not null, wrap it in one.

```php
public static wrap(mixed $value): array
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$value` | **mixed** |  |




***


***
> Automatically generated from source code comments on 2023-08-26 using [phpDocumentor](http://www.phpdoc.org/) and [saggre/phpdocumentor-markdown](https://github.com/Saggre/phpDocumentor-markdown)
