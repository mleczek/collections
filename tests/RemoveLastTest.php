<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class RemoveLastTest extends TestCase
{
    public function testRemoveLastLeftPreviousCollectionUnchanged(): void
    {
        $collection = new Collection([6, 2, 9]);
        $this->assertEquals([6, 2], $collection->removeLast()->toArray());
        $this->assertEquals([6, 2, 9], $collection->toArray());
    }

    public function testRemoveLast(): void
    {
        $collection = new Collection([6, 2, 9]);
        $this->assertEquals([6, 2], $collection->removeLast()->toArray());
    }

    public function testRemoveLastMultipleItems(): void
    {
        $collection = new Collection([6, 2, 9]);
        $this->assertEquals([6], $collection->removeLast(2)->toArray());
    }

    public function testRemoveLastMultipleItemsAboveAvailable(): void
    {
        $collection = new Collection([6, 2, 9]);
        $this->assertEquals([], $collection->removeLast(5)->toArray());
    }

    public function testRemoveLastSkipIfCollectionIsEmpty(): void
    {
        $collection = new Collection([]);
        $this->assertEquals([], $collection->removeLast()->toArray());
    }
}
