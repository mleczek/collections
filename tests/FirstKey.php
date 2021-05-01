<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class FirstKey extends TestCase
{
    public function testFirst(): void
    {
        $collection = new Collection([1, 2, 9]);
        $this->assertEquals(0, $collection->firstKey());
    }

    public function testFirstObjectValue(): void
    {
        $collection = new Collection(['a' => 1, 'b' => 5]);
        $this->assertEquals('a', $collection->firstKey());
    }

    public function testFirstNullIfEmpty(): void
    {
        $collection = new Collection([]);
        $this->assertEquals(null, $collection->firstKey());
    }
}
