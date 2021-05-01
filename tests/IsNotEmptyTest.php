<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class IsNotEmptyTest extends TestCase
{
    public function testIsEmpty(): void
    {
        $collection = new Collection([]);
        $this->assertFalse($collection->isNotEmpty());
    }

    public function testIsNotEmptySpecial(): void
    {
        $collection = new Collection([[]]);
        $this->assertTrue($collection->isNotEmpty());
    }

    public function testIsNotEmpty(): void
    {
        $collection = new Collection([1, 6]);
        $this->assertTrue($collection->isNotEmpty());
    }
}
