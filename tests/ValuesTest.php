<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class ValuesTest extends TestCase
{
    public function testValuesEmptyArray(): void
    {
        $collection = new Collection([]);
        $this->assertEquals([], $collection->values());
    }

    public function testValuesIndexedArray(): void
    {
        $collection = new Collection([1, 5, 2]);
        $this->assertEquals([1, 5, 2], $collection->values());
    }

    public function testValuesAssociativeArray(): void
    {
        $collection = new Collection([1 => 'a', 'b' => 5, 2 => 'c']);
        $this->assertEquals(['a', 5, 'c'], $collection->values());
    }
}
