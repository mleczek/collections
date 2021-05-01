<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class RemoveFirstTest extends TestCase
{
    public function testRemoveFirstLeftPreviousCollectionUnchanged(): void
    {
        $collection = new Collection([6, 2, 9]);
        $this->assertEquals([2, 9], $collection->removeFirst()->toArray());
        $this->assertEquals([6, 2, 9], $collection->toArray());
    }

    public function testRemoveFirst(): void
    {
        $collection = new Collection([6, 2, 9]);
        $this->assertEquals([2, 9], $collection->removeFirst()->toArray());
    }

    public function testRemoveFirstMultipleItems(): void
    {
        $collection = new Collection([6, 2, 9]);
        $this->assertEquals([9], $collection->removeFirst(2)->toArray());
    }

    public function testRemoveFirstMultipleItemsAboveAvailable(): void
    {
        $collection = new Collection([6, 2, 9]);
        $this->assertEquals([], $collection->removeFirst(5)->toArray());
    }

    public function testRemoveFirstSkipIfCollectionIsEmpty(): void
    {
        $collection = new Collection([]);
        $this->assertEquals([], $collection->removeFirst()->toArray());
    }
}
