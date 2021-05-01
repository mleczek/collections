# PHP Collections

This package was created to provide simple way to manipulate arrays in PHP. The package was inspired by the Laravel Collections.

## Installation

```
composer require mleczek/collections
```

## Getting started

Convert any array to collection:

```php
$collection = new \Mleczek\Collections\Collection([
    ['id' => 3, 'firstName' => 'Debra', 'lastName' => 'Barnett'],
    ['id' => 8, 'firstName' => 'Ronnie', 'lastName' => 'Coleman'],
    ['id' => 2, 'firstName' => 'Gabriel', 'lastName' => 'Adams'],
]);

// ...and perform some operations:
$names = $collection
    ->whereIn(fn($x) => $x['id'], [3, 2])
    ->map(fn($x) => $x['firstName'] .' '. $x['lastName'])
    ->join(', ');

// $names is equal "Debra Barnett, Gabriel Adams"
```

You can also do this using `collection` helper method:

```php
$sum = collection([1, 2, 5])
    ->map(fn($x) => $x * 2)
    ->sum();

// $sum is equal 16 (2+4+10)
```

## Available operations

- [addFirst](#addFirst)
- [addLast](#addLast)
- [avg](#avg)
- [chunk](#chunk)
- [count](#count)
- [each](#each)
- [firstKey](#firstKey)
- [first](#first)
- [flatten](#flatten)
- [groupBy](#groupBy)
- [has](#has)
- [isAssociative](#isAssociative)
- [isEmpty](#isEmpty)
- [isIndexed](#isIndexed)
- [isNotEmpty](#isNotEmpty)
- [join](#join)
- [keyBy](#each)
- [keys](#keys)
- [lastKey](#lastKey)
- [last](#last)
- [map](#map)
- [max](#max)
- [merge](#merge)
- [min](#min)
- [randomKey](#randomKey)
- [random](#random)
- [reduce](#reduce)
- [removeFirst](#removeFirst)
- [removeLast](#removeLast)
- [reverse](#reverse)
- [skip](#skip)
- [sortDesc](#sortDesc)
- [sort](#sort)
- [sum](#sum)
- [take](#take)
- [toArray](#toArray)
- [unique](#unique)
- [values](#values)
- [whereIn](#whereIn)
- [where](#where)

### addFirst

Add item at the beginning of the collection.

```php
$collection = collection([2, 3])->addFirst(1);
```

### addLast

Add item at the end of the collection.

```php
$collection = collection([2, 3])->addLast(4);
```

### avg

Calculate average value from items. Zero if there're no items in collection.

```php
$avg = collection([1, 2, 6])->avg();
``` 

```php
$items = [
    ['value' => 3],
    ['value' => 7],
];

$avg = collection($items)
    ->avg(fn($item, $key) => $item['value']);
```

Throws when trying to calculate avg from non-number value.

### chunk

Breaks into multiple, smaller collections of a given size.

E.g. for chunk size 2 the output array for `[1, 2, 3]` will be `[[1, 2], [3]]`.

```php
$collection = collection([1, 2, 3])->chunk(2);
```

### count

The total number of items in the collection.

```php
$count = collection([1, 2])->count();
```

### each

Iterate over each item.

```php
collection(['a' => 1, 'b' => 2])
    ->each(fn($item, $key) => printf("$key:$item"));
```

### firstKey

Get first item key.

```php
$key = collection(['a' => 1, 'b' => 2])->firstKey();
```

### first

Get first item value.

```php
$item = collection(['a' => 1, 'b' => 2])->first();
```

### flatten

Convert array of arrays to array (remove one dimension).

E.g. Flattening the `[[1, 2], [3]]` array will output `[1, 2, 3]`.

```php
$collection = collection([[1, 2], [3]])->flatten();
```

### groupBy

Groups the collection's items by a given key.

```php
$items = [
    ['brand' => 'Jeep', 'model' => 'Cherokee Latitude'],
    ['brand' => 'Nissan', 'model' => 'Sentra SV'],
    ['brand' => 'Nissan', 'model' => 'Murano Platinum'],
];

$collection = collection($items)
    ->groupBy(fn($item, $key) => $item['brand']);
```

### has

Check whether collection has items which match given closure.

```php
$test = collection([2, 7, 3])
    ->has(fn($item, $key) => $item === 7);
```

### isAssociative

Check whether collection is an associative array.

```php
$test = collection(['a' => 1, 4])->isAssociative();
```

See also [`isIndexed`](#isIndexed) method.

### isEmpty

Check whether collection has zero items.

```php
$test = collection([])->isEmpty();
```

### isIndexed

Check whether collection is an indexed array.

```php
$test = collection(['a' => 1, 4])->isIndexed();
```

See also [`isAssociative`](#isAssociative) method.

### isNotEmpty

Check whether collection has any item.

```php
$test = collection([8, 2])->isNotEmpty();
```

### join

Join all items with given glue.

```php
$string = collection(['Nissan', 'Jeep', 'Ford'])->join(', ');
```

### keyBy

Change collection's items keys.

```php
$items = [
    ['id' => 5, 'username' => 'lorraine'],
    ['id' => 1, 'username' => 'gabriel.hill'],
    ['id' => 4, 'username' => 'steward'],
];

$collection = collection($items)
    ->keyBy(fn($item, $key) => $item['id']);
```

If multiple items have the same key, the exception will be thrown.

### keys

Returns all of the collection's keys.

```php
$array = collection(['a' => 1, 'b' => 3])->keys();
```

### lastKey

Get last item key.
 
 ```php
$key = collection(['a' => 1, 'b' => 2])->lastKey();
 ```

### last

Get last item value.
 
 ```php
$item = collection(['a' => 1, 'b' => 2])->last();
 ```

### map

Iterates through the collection and modify each item.

```php
$collection = collection([1, 4])
    ->map(fn($item, $key) => $item * 2);
```

Array keys are preserved.

### max

Get maximum value from items.

The ">" operator is used to find maximum value.

```php
$max = collection([1, 4, 7])->max();
```

```php
$items = [
    ['value' => 3],
    ['value' => 7],
];

$avg = collection($items)
    ->max(fn($item, $key) => $item['value']);
```

### merge

Merge collection/array to current array.

In associative arrays values for existing keys will be overwrite.
In indexed arrays new values are always appended at the end of collection.

```php
$collection = collection([1, 2])->merge([3, 4]);
```

```php
$first = collection([1, 2]);
$second = collection(['a' => 1, 'b' => 2]);

$collection = $first->merge($second);
```

### min

Get minimum value from items.

The "<" operator is used to find minimum value.

```php
$max = collection([1, 4, 7])->min();
```

```php
$items = [
    ['value' => 3],
    ['value' => 7],
];

$avg = collection($items)
    ->min(fn($item, $key) => $item['value']);
```

### randomKey

Get random key from collection.

Returns null if collection is empty.

```php
$item = collection(['a' => 1, 'b' => 2])->randomKey();
```

### random

Get random item value.

Returns null if collection is empty.

```php
$item = collection([1, 8, 4])->random();
```

### reduce

Reduces the collection to a single value, passing the result of each iteration into the subsequent iteration.

```php
$initialState = 2;
$result = collection([1, 8, 4])
    ->reduce(fn($item, $state) => $state + $item, $initialState);
```

### removeFirst

Remove first N items from collection.

```php
$collection = collection([1, 8, 4])->removeFirst();
$collection = collection([1, 8, 4])->removeFirst(2);
```

### removeLast

Remove last N items from collection.

```php
$collection = collection([1, 8, 4])->removeLast();
$collection = collection([1, 8, 4])->removeLast(2);
```

### reverse

Reverse items order.

```php
$collection = collection([1, 8, 4])->reverse();
```

### skip

Skip N first items.

```php
$collection = collection([1, 8, 4])->skip();
$collection = collection([1, 8, 4])->skip(2);
```

### sortDesc

Sort items descending.

Strings are sorted in case insensitive manner.

```php
$collection = collection([1, 8, 4])->sortDesc();
```

```php
$items = [
    ['value' => 3],
    ['value' => 7],
];

$collection = collection($items)
    ->sortDesc(fn($item) => $item['value']);
```

See also [`sort`](#sort) method.

### sort

Sort items ascending.

Strings are sorted in case insensitive manner.

```php
$collection = collection([1, 8, 4])->sort();
```

```php
$items = [
    ['value' => 3],
    ['value' => 7],
];

$collection = collection($items)
    ->sort(fn($item) => $item['value']);
```

See also [`sortDesc`](#sortDesc) method.

### sum

Returns the sum of all items in the collection.

```php
$sum = collection([1, 2, 6])->sum();
``` 

```php
$items = [
    ['value' => 3],
    ['value' => 7],
];

$sum = collection($items)
    ->sum(fn($item, $key) => $item['value']);
```

Throws when trying to calculate sum from non-number value.

### take

Take N first items.

```php
$collection = collection([1, 8, 4])->take();
$collection = collection([1, 8, 4])->take(2);
```

### toArray

Returns collection's items.

```php
$array = collection([6, 3, 1])->toArray();
```

### unique

Left only items with unique value.

```php
$collection = collection([6, 1, 3, 1])->unique();
```

First occurrence is taken if multiple same values are encountered.

```php
$items = [
    ['brand' => 'Jeep', 'model' => 'Cherokee Latitude'],
    ['brand' => 'Nissan', 'model' => 'Sentra SV'],
    ['brand' => 'Nissan', 'model' => 'Murano Platinum'],
];

$collection = collection([$items])
    ->unique(fn($item, $key) => $item['brand']);
```

### values

Returns all of the collection's values (as indexed array).

```php
$values = collection(['a' => 1, 'b' => 2])->values();
```

### whereIn

Return collection with items that needle is in haystack of accepted values.

```php
$collection = collection([8, 4, 2])
    ->whereIn(fn($item, $key) => $item, [4, 7, 2]);
```

### where

Return collection with items which match given criteria.

```php
$collection = collection([8, 4, 2])
    ->where(fn($item, $key) => $item > 3);
```
