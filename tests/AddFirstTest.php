<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class AddFirstTest extends TestCase
{
    public function testAddFirst(): void
    {
        $collection = new Collection([1, 2]);
        $result = $collection->addFirst(3)->toArray();
        $this->assertEquals([3, 1, 2], $result);
    }

    public function testAddFirstLeftPreviousCollectionUnchanged(): void
    {
        $collection = new Collection([1, 2]);
        $collection->addFirst(3);
        $this->assertEquals([1, 2], $collection->toArray());
    }
}
