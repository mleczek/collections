<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class RandomKeyTest extends TestCase
{
    public function testRandomKey(): void
    {
        $collection = new Collection(['a' => 5, 3 => 'b', 'c' => 1]);
        $this->assertContains($collection->randomKey(), ['a', 3, 'c']);
    }

    public function testRandomKeyReturnsNullIfCollectionIsEmpty(): void
    {
        $collection = new Collection([]);
        $this->assertNull($collection->randomKey());
    }
}
