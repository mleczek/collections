<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class IsEmptyTest extends TestCase
{
    public function testIsEmpty(): void
    {
        $collection = new Collection([]);
        $this->assertTrue($collection->isEmpty());
    }

    public function testIsNotEmptySpecial(): void
    {
        $collection = new Collection([[]]);
        $this->assertFalse($collection->isEmpty());
    }

    public function testIsNotEmpty(): void
    {
        $collection = new Collection([1, 6]);
        $this->assertFalse($collection->isEmpty());
    }
}
