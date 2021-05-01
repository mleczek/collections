<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class LastTest extends TestCase
{
    public function testFirst(): void
    {
        $collection = new Collection([1, 2, 9]);
        $this->assertEquals(9, $collection->last());
    }

    public function testFirstObjectValue(): void
    {
        $collection = new Collection(['a' => 1, 'b' => 5]);
        $this->assertEquals(5, $collection->last());
    }

    public function testFirstNullIfEmpty(): void
    {
        $collection = new Collection([]);
        $this->assertEquals(null, $collection->last());
    }
}
