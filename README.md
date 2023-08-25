# StellarWP Arrays

[![Tests](https://github.com/stellarwp/arrays/workflows/Tests/badge.svg)](https://github.com/stellarwp/arrays/actions?query=branch%3Amain) [![Static Analysis](https://github.com/stellarwp/arrays/actions/workflows/static-analysis.yml/badge.svg)](https://github.com/stellarwp/arrays/actions/workflows/static-analysis.yml)

A library for array manipulations.

## Table of contents

* [Installation](#installation)
* [Notes on examples](#notes-on-examples)
* Array utils
  * [add_prefixed_keys_to](/docs/classes/StellarWP/Arrays/Array_Utils.md#add_prefixed_keys_to)
  * [add_unprefixed_keys_to](/docs/classes/StellarWP/Arrays/Array_Utils.md#add_unprefixed_keys_to)
  * [array_visit_recursive](/docs/classes/StellarWP/Arrays/Array_Utils.md#array_visit_recursive)
  * [destringify_keys](/docs/classes/StellarWP/Arrays/Array_Utils.md#destringify_keys)
  * [escape_multidimensional_array](/docs/classes/StellarWP/Arrays/Array_Utils.md#escape_multidimensional_array)
  * [filter_to_flat_scalar_associative_array](/docs/classes/StellarWP/Arrays/Array_Utils.md#filter_to_flat_scalar_associative_array)
  * [filter_prefixed](/docs/classes/StellarWP/Arrays/Array_Utils.md#filter_prefixed)
  * [flatten](/docs/classes/StellarWP/Arrays/Array_Utils.md#flatten)
  * [get](/docs/classes/StellarWP/Arrays/Array_Utils.md#get)
  * [get_first_set](/docs/classes/StellarWP/Arrays/Array_Utils.md#get_first_set)
  * [get_in_any](/docs/classes/StellarWP/Arrays/Array_Utils.md#get_in_any)
  * [insert_after_key](/docs/classes/StellarWP/Arrays/Array_Utils.md#insert_after_key)
  * [insert_before_key](/docs/classes/StellarWP/Arrays/Array_Utils.md#insert_before_key)
  * [list_to_array](/docs/classes/StellarWP/Arrays/Array_Utils.md#list_to_array)
  * [map_or_discard](/docs/classes/StellarWP/Arrays/Array_Utils.md#map_or_discard)
  * [merge_recursive](/docs/classes/StellarWP/Arrays/Array_Utils.md#merge_recursive)
  * [merge_recursive_query_vars](/docs/classes/StellarWP/Arrays/Array_Utils.md#merge_recursive_query_vars)
  * [parse_associative_array_alias](/docs/classes/StellarWP/Arrays/Array_Utils.md#parse_associative_array_alias)
  * [recursive_ksort](/docs/classes/StellarWP/Arrays/Array_Utils.md#recursive_ksort)
  * [remove_numeric_keys_recursive](/docs/classes/StellarWP/Arrays/Array_Utils.md#remove_numeric_keys_recursive)
  * [remove_string_keys_recursive](/docs/classes/StellarWP/Arrays/Array_Utils.md#remove_string_keys_recursive)
  * [set](/docs/classes/StellarWP/Arrays/Array_Utils.md#set)
  * [shape_filter](/docs/classes/StellarWP/Arrays/Array_Utils.md#shape_filter)
  * [stringify_keys](/docs/classes/StellarWP/Arrays/Array_Utils.md#stringify_keys)
  * [strpos](/docs/classes/StellarWP/Arrays/Array_Utils.md#strpos)
  * [to_list](/docs/classes/StellarWP/Arrays/Array_Utils.md#to_list)
  * [usearch](/docs/classes/StellarWP/Arrays/Array_Utils.md#usearch)

## Installation

It's recommended that you install Arrays as a project dependency via [Composer](https://getcomposer.org/):

```bash
composer require stellarwp/arrays
```

> We _actually_ recommend that this library gets included in your project using [Strauss](https://github.com/BrianHenryIE/strauss).
>
> Luckily, adding Strauss to your `composer.json` is only slightly more complicated than adding a typical dependency, so checkout our [strauss docs](https://github.com/stellarwp/global-docs/blob/main/docs/strauss-setup.md).

## Notes on examples

Since the recommendation is to use Strauss to prefix this library's namespaces, all examples will be using the `Boomshakalaka` namespace prefix.
