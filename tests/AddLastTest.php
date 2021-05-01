<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class AddLastTest extends TestCase
{
    public function testAddLast(): void
    {
        $collection = new Collection([1, 2]);
        $result = $collection->addLast(3)->toArray();
        $this->assertEquals([1, 2, 3], $result);
    }

    public function testAddLastLeftPreviousCollectionUnchanged(): void
    {
        $collection = new Collection([1, 2]);
        $collection->addLast(3);
        $this->assertEquals([1, 2], $collection->toArray());
    }
}
