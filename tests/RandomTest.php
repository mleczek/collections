<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class RandomTest extends TestCase
{
    public function testRandomKey(): void
    {
        $collection = new Collection(['a' => 5, 3 => 'b', 'c' => 1]);
        $this->assertContains($collection->random(), [5, 'b', 1]);
    }

    public function testRandomKeyReturnsNullIfCollectionIsEmpty(): void
    {
        $collection = new Collection([]);
        $this->assertNull($collection->randomKey());
    }
}
