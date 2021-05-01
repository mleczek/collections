<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class FirstTest extends TestCase
{
    public function testFirst(): void
    {
        $collection = new Collection([1, 2, 9]);
        $this->assertEquals(1, $collection->first());
    }

    public function testFirstObjectValue(): void
    {
        $collection = new Collection(['a' => 1, 'b' => 5]);
        $this->assertEquals(1, $collection->first());
    }

    public function testFirstNullIfEmpty(): void
    {
        $collection = new Collection([]);
        $this->assertEquals(null, $collection->first());
    }
}
