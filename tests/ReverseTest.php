<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class ReverseTest extends TestCase
{
    public function testReverse(): void
    {
        $collection = new Collection([6, 2, 9, 4]);
        $this->assertEquals([4, 9, 2, 6], $collection->reverse()->toArray());
    }
}
