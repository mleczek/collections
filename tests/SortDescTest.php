<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class SortDescTest extends TestCase
{
    public function testSortDescNumbers(): void
    {
        $collection = new Collection([1, 8, 4, 2, 4]);
        $result = $collection->sortDesc()->toArray();
        $this->assertEquals([8, 4, 4, 2, 1], $result);
    }

    public function testSortDescStrings(): void
    {
        $collection = new Collection(['a', 'bz', 'c', 'bn', 'aa']);
        $result = $collection->sortDesc()->toArray();
        $this->assertEquals(['c', 'bz', 'bn', 'aa', 'a'], $result);
    }

    public function testSortDescKeepKeys(): void
    {
        $collection = new Collection(['a' => 3, 'b' => 2, 'c' => 5]);
        $result = $collection->sortDesc()->toArray();
        $this->assertEquals(['c' => 5, 'a' => 3, 'b' => 2], $result);
    }

    public function testSortDescStringsCaseInsensitive(): void
    {
        $collection = new Collection(['C', 'A', 'b']);
        $result = $collection->sortDesc()->toArray();
        $this->assertEquals(['C', 'b', 'A'], $result);

        $collection = new Collection(['a', 'c', 'B']);
        $result = $collection->sortDesc()->toArray();
        $this->assertEquals(['c', 'B', 'a'], $result);
    }

    public function testSortDescByObjectProperty(): void
    {
        $collection = new Collection([
            ['a' => 4, 'b' => 5],
            ['a' => 2, 'b' => 1],
            ['a' => 3, 'b' => 9],
        ]);

        $result = $collection->sortDesc(fn($x) => $x['a'])->toArray();
        $expected = [
            ['a' => 4, 'b' => 5],
            ['a' => 3, 'b' => 9],
            ['a' => 2, 'b' => 1],
        ];

        $this->assertEquals($expected, $result);
    }

    public function testSortDescLeftPreviousCollectionUnchanged(): void
    {
        $collection = new Collection([1, 4, 2]);
        $this->assertEquals([4, 2, 1], $collection->sortDesc()->toArray());
        $this->assertEquals([1, 4, 2], $collection->toArray());
    }
}
