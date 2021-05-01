<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class SortTest extends TestCase
{
    public function testSortNumbers(): void
    {
        $collection = new Collection([1, 8, 4, 2, 4]);
        $result = $collection->sort()->toArray();
        $this->assertEquals([1, 2, 4, 4, 8], $result);
    }

    public function testSortStrings(): void
    {
        $collection = new Collection(['a', 'bz', 'c', 'bn', 'aa']);
        $result = $collection->sort()->toArray();
        $this->assertEquals(['a', 'aa', 'bn', 'bz', 'c'], $result);
    }

    public function testSortKeepKeys(): void
    {
        $collection = new Collection(['a' => 3, 'b' => 2, 'c' => 5]);
        $result = $collection->sort()->toArray();
        $this->assertEquals(['b' => 2, 'a' => 3, 'c' => 5], $result);
    }

    public function testSortStringsCaseInsensitive(): void
    {
        $collection = new Collection(['C', 'A', 'b']);
        $result = $collection->sort()->toArray();
        $this->assertEquals(['A', 'b', 'C'], $result);

        $collection = new Collection(['a', 'c', 'B']);
        $result = $collection->sort()->toArray();
        $this->assertEquals(['a', 'B', 'c'], $result);
    }

    public function testSortByObjectProperty(): void
    {
        $collection = new Collection([
            ['a' => 4, 'b' => 5],
            ['a' => 2, 'b' => 1],
            ['a' => 3, 'b' => 9],
        ]);

        $result = $collection->sort(fn($x) => $x['a'])->toArray();
        $expected = [
            ['a' => 2, 'b' => 1],
            ['a' => 3, 'b' => 9],
            ['a' => 4, 'b' => 5],
        ];

        $this->assertEquals($expected, $result);
    }

    public function testSortLeftPreviousCollectionUnchanged(): void
    {
        $collection = new Collection([1, 4, 2]);
        $this->assertEquals([1, 2, 4], $collection->sort()->toArray());
        $this->assertEquals([1, 4, 2], $collection->toArray());
    }
}
