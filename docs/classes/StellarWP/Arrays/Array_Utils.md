***

# Array_Utils

Array utilities



* Full name: `\StellarWP\Arrays\Array_Utils`


* [add_prefixed_keys_to](#add_prefixed_keys_to)
* [add_unprefixed_keys_to](#add_unprefixed_keys_to)
* [array_visit_recursive](#array_visit_recursive)
* [destringify_keys](#destringify_keys)
* [escape_multidimensional_array](#escape_multidimensional_array)
* [filter_to_flat_scalar_associative_array](#filter_to_flat_scalar_associative_array)
* [filter_prefixed](#filter_prefixed)
* [flatten](#flatten)
* [get](#get)
* [get_first_set](#get_first_set)
* [get_in_any](#get_in_any)
* [list_to_array](#list_to_array)
* [map_or_discard](#map_or_discard)
* [merge_recursive_query_vars](#merge_recursive_query_vars)
* [parse_associative_array_alias](#parse_associative_array_alias)
* [recursive_ksort](#recursive_ksort)
* [remove_numeric_keys_recursive](#remove_numeric_keys_recursive)
* [remove_string_keys_recursive](#remove_string_keys_recursive)
* [set](#set)
* [shape_filter](#shape_filter)
* [stringify_keys](#stringify_keys)
* [strpos](#strpos)
* [to_list](#to_list)
* [usearch](#usearch)

## Methods


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

### flatten

Flattens an array transforming each value that is an array and only contains one
element into that one element.

```php
public static flatten(array $array): array
```

Typical use case is to flatten arrays like those returned by `get_post_meta( $id )`.
Empty arrays are replaced with an empty string.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** | The array to flatten. |


**Return Value:**

The flattened array.



***

### get

Find a value inside of an array or object, including one nested a few levels deep.

```php
public static get(array|object|mixed $variable, array|string $indexes, mixed $default = null): mixed
```

Example: get( $a, [ 0, 1, 2 ] ) returns the value of $a[0][1][2] or the default.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$variable` | **array&#124;object&#124;mixed** | Array or object to search within. |
| `$indexes` | **array&#124;string** | Specify each nested index in order.<br />Example: array( &#039;lvl1&#039;, &#039;lvl2&#039; ); |
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


***
> Automatically generated from source code comments on 2023-08-25 using [phpDocumentor](http://www.phpdoc.org/) and [saggre/phpdocumentor-markdown](https://github.com/Saggre/phpDocumentor-markdown)
