# StellarWP Arrays

[![Tests](https://github.com/stellarwp/arrays/workflows/Tests/badge.svg)](https://github.com/stellarwp/arrays/actions?query=branch%3Amain) [![Static Analysis](https://github.com/stellarwp/arrays/actions/workflows/static-analysis.yml/badge.svg)](https://github.com/stellarwp/arrays/actions/workflows/static-analysis.yml)

A library for array manipulations.

## Table of contents

* [Installation](#installation)
* [Notes on examples](#notes-on-examples)
* Array utils
  * [accessible](/docs/classes/StellarWP/Arrays/Arr.md#accessible)
  * [add](/docs/classes/StellarWP/Arrays/Arr.md#add)
  * [add_prefixed_keys_to](/docs/classes/StellarWP/Arrays/Arr.md#add_prefixed_keys_to)
  * [add_unprefixed_keys_to](/docs/classes/StellarWP/Arrays/Arr.md#add_unprefixed_keys_to)
  * [array_visit_recursive](/docs/classes/StellarWP/Arrays/Arr.md#array_visit_recursive)
  * [collapse](/docs/classes/StellarWP/Arrays/Arr.md#collapse)
  * [destringify_keys](/docs/classes/StellarWP/Arrays/Arr.md#destringify_keys)
  * [dot](/docs/classes/StellarWP/Arrays/Arr.md#dot)
  * [escape_multidimensional_array](/docs/classes/StellarWP/Arrays/Arr.md#escape_multidimensional_array)
  * [except](/docs/classes/StellarWP/Arrays/Arr.md#except)
  * [exists](/docs/classes/StellarWP/Arrays/Arr.md#exists)
  * [filter_to_flat_scalar_associative_array](/docs/classes/StellarWP/Arrays/Arr.md#filter_to_flat_scalar_associative_array)
  * [filter_prefixed](/docs/classes/StellarWP/Arrays/Arr.md#filter_prefixed)
  * [first](/docs/classes/StellarWP/Arrays/Arr.md#first)
  * [flatten](/docs/classes/StellarWP/Arrays/Arr.md#flatten)
  * [forget](/docs/classes/StellarWP/Arrays/Arr.md#forget)
  * [get](/docs/classes/StellarWP/Arrays/Arr.md#get)
  * [get_first_set](/docs/classes/StellarWP/Arrays/Arr.md#get_first_set)
  * [get_in_any](/docs/classes/StellarWP/Arrays/Arr.md#get_in_any)
  * [has](/docs/classes/StellarWP/Arrays/Arr.md#has)
  * [has_shape]/docs/classes/StellarWP/Arrays/Arr.md#has_shape)
  * [insert_after_key](/docs/classes/StellarWP/Arrays/Arr.md#insert_after_key)
  * [insert_before_key](/docs/classes/StellarWP/Arrays/Arr.md#insert_before_key)
  * [is_assoc](/docs/classes/StellarWP/Arrays/Arr.md#is_assoc)
  * [is_list](/docs/classes/StellarWP/Arrays/Arr.md#is_list)
  * [join](/docs/classes/StellarWP/Arrays/Arr.md#join)
  * [last](/docs/classes/StellarWP/Arrays/Arr.md#last)
  * [list_to_array](/docs/classes/StellarWP/Arrays/Arr.md#list_to_array)
  * [map_or_discard](/docs/classes/StellarWP/Arrays/Arr.md#map_or_discard)
  * [merge_recursive](/docs/classes/StellarWP/Arrays/Arr.md#merge_recursive)
  * [merge_recursive_query_vars](/docs/classes/StellarWP/Arrays/Arr.md#merge_recursive_query_vars)
  * [only](/docs/classes/StellarWP/Arrays/Arr.md#only)
  * [parse_associative_array_alias](/docs/classes/StellarWP/Arrays/Arr.md#parse_associative_array_alias)
  * [prepend](/docs/classes/StellarWP/Arrays/Arr.md#prepend)
  * [pull](/docs/classes/StellarWP/Arrays/Arr.md#pull)
  * [query](/docs/classes/StellarWP/Arrays/Arr.md#query)
  * [random](/docs/classes/StellarWP/Arrays/Arr.md#random)
  * [recursive_ksort](/docs/classes/StellarWP/Arrays/Arr.md#recursive_ksort)
  * [remove_numeric_keys_recursive](/docs/classes/StellarWP/Arrays/Arr.md#remove_numeric_keys_recursive)
  * [remove_string_keys_recursive](/docs/classes/StellarWP/Arrays/Arr.md#remove_string_keys_recursive)
  * [set](/docs/classes/StellarWP/Arrays/Arr.md#set)
  * [shape_filter](/docs/classes/StellarWP/Arrays/Arr.md#shape_filter)
  * [shuffle](/docs/classes/StellarWP/Arrays/Arr.md#shuffle)
  * [sort_by_priority](/docs/classes/StellarWP/Arrays/Arr.md#sort_by_priority)
  * [sort_recursive](/docs/classes/StellarWP/Arrays/Arr.md#sort_recursive)
  * [sort_recursive_desc](/docs/classes/StellarWP/Arrays/Arr.md#sort_recursive_desc)
  * [stringify_keys](/docs/classes/StellarWP/Arrays/Arr.md#stringify_keys)
  * [strpos](/docs/classes/StellarWP/Arrays/Arr.md#strpos)
  * [to_list](/docs/classes/StellarWP/Arrays/Arr.md#to_list)
  * [undot](/docs/classes/StellarWP/Arrays/Arr.md#undot)
  * [usearch](/docs/classes/StellarWP/Arrays/Arr.md#usearch)
  * [where](/docs/classes/StellarWP/Arrays/Arr.md#where)
  * [where_not_null](/docs/classes/StellarWP/Arrays/Arr.md#where_not_null)
  * [wrap](/docs/classes/StellarWP/Arrays/Arr.md#wrap)
* [Acknowledgements](#acknowledgements)

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

## Acknowledgements

A number of array methods were ported over from [The Events Calendar](https://theeventscalendar.com) and the [Laravel Framework](https://github.com/laravel/framework).
