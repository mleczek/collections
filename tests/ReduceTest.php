<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class ReduceTest extends TestCase
{
    public function testReduceWithDefaultInitialValue(): void
    {
        $collection = new Collection([4, 2, 5]);
        $result = $collection->reduce(fn($x, $state) => $state + $x);
        $this->assertEquals(11, $result);
    }

    public function testReduceWithInitialValue(): void
    {
        $collection = new Collection([4, 2, 5]);
        $result = $collection->reduce(fn($x, $state) => $state + $x, 20);
        $this->assertEquals(31, $result);
    }

    public function testReduceWithEmptyCollection(): void
    {
        $collection = new Collection([]);
        $result = $collection->reduce(fn($x, $state) => $state + $x, 15);
        $this->assertEquals(15, $result);
    }
}
