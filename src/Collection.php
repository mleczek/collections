<?php

namespace Mleczek\Collections;


use Closure;
use InvalidArgumentException;

class Collection implements CollectionInterface
{
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function map(Closure $operation): CollectionInterface
    {
        $result = [];
        foreach ($this->items as $key => $item) {
            $value = $operation($item, $key);

            if($this->isAssociative()) {
                $result[$key] = $value;
            } else {
                $result[] = $value;
            }
        }

        return new Collection($result);
    }

    public function avg(?Closure $operation = null): float
    {
        if ($this->count() === 0) {
            return 0;
        }

        $result = 0;
        $operation = $operation ?? fn($x) => $x;
        foreach ($this->items as $key => $item) {
            $value = $operation($item, $key);
            if (!is_numeric($value)) {
                $type = gettype($value);
                throw new InvalidArgumentException("The number was expected to calculate average value, got $type.");
            }

            $result += $value;
        }

        return $result / $this->count();
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function min(?Closure $operation = null)
    {
        $result = null;
        $operation = $operation ?? fn($x) => $x;
        foreach ($this->items as $key => $item) {
            $value = $operation($item, $key);
            if (is_null($result) || $value < $result) {
                $result = $value;
            }
        }

        return $result;
    }

    public function max(?Closure $operation = null)
    {
        $result = null;
        $operation = $operation ?? fn($x) => $x;
        foreach ($this->items as $key => $item) {
            $value = $operation($item, $key);
            if (is_null($result) || $value > $result) {
                $result = $value;
            }
        }

        return $result;
    }

    public function has(Closure $operation): bool
    {
        foreach ($this->items as $key => $item) {
            $value = $operation($item, $key);
            if (!is_bool($value)) {
                $type = gettype($value);
                throw new InvalidArgumentException("The boolean was expected to check if collection has given item, got $type.");
            }

            if ($value) {
                return true;
            }
        }

        return false;
    }

    public function chunk(int $size): CollectionInterface
    {
        $preserveKeys = $this->isAssociative();

        return new Collection(
            array_chunk($this->items, $size, $preserveKeys)
        );
    }

    public function isIndexed(): bool
    {
        $index = 0;
        foreach (array_keys($this->items) as $key) {
            if ($key !== $index) {
                return false;
            }

            $index++;
        }

        return true;
    }

    public function isAssociative(): bool
    {
        return !$this->isIndexed();
    }

    public function each(Closure $operation): CollectionInterface
    {
        foreach ($this->items as $key => $item) {
            $operation($item, $key);
        }

        return $this;
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    public function first()
    {
        if ($this->isEmpty()) {
            return null;
        }

        return array_values($this->items)[0];
    }

    public function firstKey()
    {
        if ($this->isEmpty()) {
            return null;
        }

        return array_keys($this->items)[0];
    }

    public function last()
    {
        if ($this->isEmpty()) {
            return null;
        }

        return array_values($this->items)[$this->count() - 1];
    }

    public function lastKey()
    {
        if ($this->isEmpty()) {
            return null;
        }

        return array_keys($this->items)[$this->count() - 1];
    }

    public function flatten(): CollectionInterface
    {
        $result = [];
        foreach ($this->items as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $value);
            } else if ($this->isAssociative()) {
                $result[$key] = $value;
            } else {
                $result[] = $value;
            }
        }

        return new Collection($result);
    }

    public function merge($items): CollectionInterface
    {
        if (!($items instanceof CollectionInterface)) {
            $items = new Collection($items);
        }

        $result = $this->toArray();
        if ($items->isIndexed()) {
            foreach ($items->toArray() as $item) {
                $result[] = $item;
            }
        } else {
            foreach ($items->toArray() as $key => $item) {
                $result[$key] = $item;
            }
        }

        return new Collection($result);
    }

    public function groupBy(Closure $operation): CollectionInterface
    {
        $result = [];
        foreach ($this->items as $key => $item) {
            $groupKey = $operation($item, $key);
            if (!isset($result[$groupKey])) {
                $result[$groupKey] = [];
            }

            if ($this->isAssociative()) {
                $result[$groupKey][$key] = $item;
            } else {
                $result[$groupKey][] = $item;
            }
        }

        return new Collection($result);
    }

    public function keyBy(Closure $operation): CollectionInterface
    {
        $result = [];
        foreach ($this->items as $item) {
            $key = $operation($item);
            if (isset($result[$key])) {
                throw new InvalidArgumentException("The collection keyBy method must returns unique keys, but the '$key' key was duplicated.");
            }

            $result[$key] = $item;
        }

        return new Collection($result);
    }

    public function keys(): array
    {
        return array_keys($this->items);
    }

    public function values(): array
    {
        return array_values($this->items);
    }

    public function removeLast(int $count = 1): self
    {
        return new Collection(
            array_slice($this->items, 0, -$count)
        );
    }

    public function removeFirst(int $count = 1): self
    {
        return new Collection(
            array_slice($this->items, $count)
        );
    }

    public function addFirst($item): CollectionInterface
    {
        $result = array_slice($this->items, 0);
        array_unshift($result, $item);

        return new Collection($result);
    }

    public function addLast($item): CollectionInterface
    {
        $result = array_slice($this->items, 0);
        array_push($result, $item);

        return new Collection($result);
    }

    public function randomKey()
    {
        if($this->isEmpty()) {
            return null;
        }

        $keys = array_keys($this->items);
        $randIndex = rand(0, $this->count() - 1);

        return $keys[$randIndex];
    }

    public function random()
    {
        if($this->isEmpty()) {
            return null;
        }

        return $this->items[$this->randomKey()];
    }

    public function skip(int $count = 1): CollectionInterface
    {
        return new Collection(
            array_slice($this->items, $count)
        );
    }

    public function reverse(): CollectionInterface
    {
        $preserveKeys = $this->isAssociative();

        return new Collection(
            (array) array_reverse($this->items, $preserveKeys)
        );
    }

    public function reduce(Closure $operation, $initialValue = 0)
    {
        $result = $initialValue;
        foreach($this->items as $item) {
            $result = $operation($item, $result);
        }

        return $result;
    }

    public function where(Closure $operation): CollectionInterface
    {
        $result = [];
        foreach($this->items as $key => $item) {
            $test = $operation($item, $key);
            if (!is_bool($test)) {
                $type = gettype($test);
                throw new InvalidArgumentException("The boolean was expected to check if collection's item match given criteria in where clause, got $type.");
            }

            if($test !== true) {
                continue;
            }

            if($this->isAssociative()) {
                $result[$key] = $item;
            } else {
                $result[] = $item;
            }
        }

        return new Collection($result);
    }

    public function whereIn(Closure $operation, array $haystack): CollectionInterface
    {
        $result = [];
        foreach($this->items as $key => $item) {
            $value = $operation($item, $key);
            if(!in_array($value, $haystack, true)) {
                continue;
            }

            if($this->isAssociative()) {
                $result[$key] = $item;
            } else {
                $result[] = $item;
            }
        }

        return new Collection($result);
    }

    public function join(string $glue): string
    {
        return implode($glue, $this->items);
    }

    public function sort(?Closure $operation = null): CollectionInterface
    {
        $result = array_slice($this->items, 0);
        $operation = $operation ?? fn($x) => $x;
        $sortMethod = $this->isAssociative() ? 'uasort' : 'usort';

        $sortMethod($result, function($a, $b) use ($operation) {
            $a = $operation($a);
            $b = $operation($b);

            if(is_string($a) && is_string($b)) {
                return strcasecmp($a, $b);
            }

            if($a === $b) {
                return 0;
            }

             return $a < $b ? -1 : 1;
        });

        return new Collection($result);
    }

    public function sortDesc(?Closure $operation = null): CollectionInterface
    {
        return $this->sort()->reverse();
    }

    public function sum(?Closure $operation = null)
    {
        $result = 0;
        $operation = $operation ?? fn($x) => $x;
        foreach($this->items as $key => $item) {
            $value = $operation($item, $key);
            if (!is_numeric($value)) {
                $type = gettype($value);
                throw new InvalidArgumentException("The number was expected to calculate sum value, got $type.");
            }

            $result += $value;
        }

        return $result;
    }

    public function take(int $count = 1): CollectionInterface
    {
        return new Collection(
            array_slice($this->items, 0, $count)
        );
    }

    public function unique(?Closure $operation = null): CollectionInterface
    {
        $result = [];
        $uniqueValues = [];
        $operation = $operation ?? fn($x) => $x;
        foreach($this->items as $key => $item) {
            $value = $operation($item, $key);
            if(in_array($value, $uniqueValues, true)) {
                continue;
            }

            if($this->isAssociative()) {
                $result[$key] = $item;
            } else {
                $result[] = $item;
            }

            $uniqueValues[] = $value;
        }

        return new Collection($result);
    }
}
