<?php


namespace Mleczek\Collections;


use Closure;
use InvalidArgumentException;

interface CollectionInterface
{
    /**
     * Iterates through the collection and modify each item.
     *
     * Array keys are preserved.
     *
     * @param Closure $operation fn($item, $key) => $newItem
     * @return $this The new collection, previous one is left unchanged.
     */
    public function map(Closure $operation): self;

    /**
     * Calculate average value from items.
     *
     * @throws InvalidArgumentException Throws when trying to calculate avg from non-number value.
     * @param Closure $operation fn($item, $key) => $number
     * @return float Average value, zero if there're no items in collection.
     */
    public function avg(?Closure $operation = null): float;

    /**
     * The total number of items in the collection.
     *
     * @return int Number of items at first level.
     */
    public function count(): int;

    /**
     * Get minimum value from items.
     *
     * The "<" operator is used to find minimum value.
     *
     * @param Closure|null $operation fn($item, $key) => $number
     * @return mixed|null Null if there're no items in collection.
     */
    public function min(?Closure $operation = null);

    /**
     * Get maximum value from items.
     *
     * The ">" operator is used to find maximum value.
     *
     * @param Closure|null $operation fn($item, $key) => $number
     * @return mixed|null Null if there're no items in collection.
     */
    public function max(?Closure $operation = null);

    /**
     * Check whether collection has items which match given closure.
     *
     * @throws InvalidArgumentException If closure not returns the boolean value.
     * @param Closure $operation fn($item, $key) => $bool
     * @return bool
     */
    public function has(Closure $operation): bool;

    /**
     * Breaks into multiple, smaller collections of a given size.
     *
     * E.g. for chunk size 2 the output array for [1,2,3] will be [[1,2],[3]].
     *
     * @param int $size
     * @return $this The new collection, previous one is left unchanged.
     */
    public function chunk(int $size): self;

    /**
     * Check whether collection is an indexed array.
     *
     * @return bool
     */
    public function isIndexed(): bool;

    /**
     * Check whether collection is an associative array.
     *
     * @return bool
     */
    public function isAssociative(): bool;

    /**
     * Iterate over each item.
     *
     * @param Closure $operation fn($item, $key) => void
     * @return $this
     */
    public function each(Closure $operation): self;

    /**
     * Get first item value.
     *
     * @return mixed
     */
    public function first();

    /**
     * Get first item key.
     *
     * @return mixed
     */
    public function firstKey();

    /**
     * Get last item value.
     *
     * @return mixed
     */
    public function last();

    /**
     * Get last item key.
     *
     * @return mixed
     */
    public function lastKey();

    /**
     * Check whether collection has zero items.
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Check whether collection has any item.
     *
     * @return bool
     */
    public function isNotEmpty(): bool;

    /**
     * Convert array of arrays to array (remove one dimension).
     *
     * E.g. Flattening the [[1,2],[3]] array will output [1,2,3].
     *
     * @return $this The new collection, previous one is left unchanged.
     */
    public function flatten(): self;

    /**
     * Merge collection/array to current array.
     *
     * In associative arrays values for existing keys will be overwrite.
     * In indexed arrays new values are always appended at the end of collection.
     *
     * @param array|CollectionInterface $items
     * @return $this The new collection, previous one is left unchanged.
     */
    public function merge($items): self;

    /**
     * Groups the collection's items by a given key.
     *
     * @param Closure $operation fn($item, $key) => $groupKey
     * @return $this The new collection, previous one is left unchanged.
     */
    public function groupBy(Closure $operation): self;

    /**
     * Change collection's items keys.
     *
     * If multiple items have the same key, the exception will be thrown.
     *
     * @throws InvalidArgumentException Throws if any key is duplicated (not unique).
     * @param Closure $operation fn($item, $key) => $newKey
     * @return $this The new collection, previous one is left unchanged.
     */
    public function keyBy(Closure $operation): self;

    /**
     * Returns all of the collection's keys.
     *
     * @return array
     */
    public function keys(): array;

    /**
     * Returns all of the collection's values (as indexed array).
     *
     * @return array
     */
    public function values(): array;

    /**
     * Remove first N items from collection.
     *
     * @param int $count Number of items to remove.
     * @return $this The new collection, previous one is left unchanged.
     */
    public function removeFirst(int $count = 1): self;

    /**
     * Remove last N items from collection.
     *
     * @param int $count Number of items to remove.
     * @return $this The new collection, previous one is left unchanged.
     */
    public function removeLast(int $count = 1): self;

    /**
     * Add item at the beginning of the collection.
     *
     * @param mixed $item
     * @return $this The new collection, previous one is left unchanged.
     */
    public function addFirst($item): self;

    /**
     * Add item at the end of the collection.
     *
     * @param mixed $item
     * @return $this The new collection, previous one is left unchanged.
     */
    public function addLast($item): self;

    /**
     * Get random key from collection.
     *
     * @return mixed|null Null if collection is empty.
     */
    public function randomKey();

    /**
     * Get random item value.
     *
     * @return mixed|null Null if collection is empty.
     */
    public function random();

    /**
     * Skip N first items.
     *
     * @param int $count Number of items to skip.
     * @return $this The new collection, previous one is left unchanged.
     */
    public function skip(int $count = 1): self;

    /**
     * Reverse items order.
     *
     * @return $this The new collection, previous one is left unchanged.
     */
    public function reverse(): self;

    /**
     * Reduces the collection to a single value, passing the result of each iteration into the subsequent iteration.
     *
     * @param Closure $operation fn($item, $prevState) => $nextState
     * @param mixed $initialValue Initial value passed to the first item callback as $prevState.
     * @return mixed Final state returned by last item.
     */
    public function reduce(Closure $operation, $initialValue = 0);

    /**
     * Return collection with items which match given criteria.
     *
     * @throws InvalidArgumentException If closure not returns the boolean value.
     * @param Closure $operation Accepts item and item's key as arguments: fn($val, $key) => ...
     * @return $this The new collection, previous one is left unchanged.
     */
    public function where(Closure $operation): self;

    /**
     * Return collection with items that needle is in haystack of accepted values.
     *
     * @param Closure $operation fn($item, $key) => $needle
     * @param array $haystack Haystack in which needle existence will be check.
     * @return $this The new collection, previous one is left unchanged.
     */
    public function whereIn(Closure $operation, array $haystack): self;

    /**
     * Join all items with given glue.
     *
     * @param string $glue
     * @return string
     */
    public function join(string $glue): string;

    /**
     * Sort items ascending.
     *
     * Strings are sorted in case insensitive manner.
     *
     * @param Closure|null $operation fn($item) => $valueToSortBy
     * @return $this The new collection, previous one is left unchanged.
     */
    public function sort(?Closure $operation = null): self;

    /**
     * Sort items descending.
     *
     * Strings are sorted in case insensitive manner.
     *
     * @param Closure|null $operation fn($item) => $valueToSortBy
     * @return $this The new collection, previous one is left unchanged.
     */
    public function sortDesc(?Closure $operation = null): self;

    /**
     * Returns the sum of all items in the collection.
     *
     * @throws InvalidArgumentException Throws when trying to calculate sum from non-number value.
     * @param Closure|null $operation fn($item, $key) => $valueToSum
     * @return int|float
     */
    public function sum(?Closure $operation = null);

    /**
     * Take N first items.
     *
     * @param int $count Number of items to take.
     * @return $this The new collection, previous one is left unchanged.
     */
    public function take(int $count = 1): self;

    /**
     * Left only items with unique value.
     *
     * First occurrence is taken if multiple same values are encountered.
     *
     * @param Closure|null $operation fn($item, $key) => $valueThatMustBeUnique
     * @return $this The new collection, previous one is left unchanged.
     */
    public function unique(?Closure $operation = null): self;

    public function toArray(): array;
}
