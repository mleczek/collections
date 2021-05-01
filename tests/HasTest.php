<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class HasTest extends TestCase
{
    public function testHasFromNumbers(): void
    {
        $collection = new Collection([1, 2, 9]);
        $this->assertTrue($collection->has(fn($x) => $x === 2));
    }

    public function testHasClosureMustReturnBoolean(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $collection = new Collection(['a', 'b']);
        $collection->has(fn($x) => $x);
    }

    public function testHasReturnsFalseIfNotFound(): void
    {
        $collection = new Collection([1, 2, 9]);
        $this->assertFalse($collection->has(fn($x) => $x === 12));
    }
}
