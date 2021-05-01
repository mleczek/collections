<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class IsIndexedTest extends TestCase
{
    public function testIsIndexed(): void
    {
        $collection = new Collection(['a', 1, [1, 3]]);
        $this->assertTrue($collection->isIndexed());
    }

    public function testIsNotIndexed(): void
    {
        $collection = new Collection(['a' => 1, 'b' => 3]);
        $this->assertFalse($collection->isIndexed());
    }

    public function testIsNotIndexedFully(): void
    {
        $collection = new Collection([1, 5, 'b' => 3]);
        $this->assertFalse($collection->isIndexed());
    }
}
