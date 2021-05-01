<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class CountTest extends TestCase
{
    public function testCount(): void
    {
        $collection = new Collection([1, 2, 9, 5, 1]);
        $this->assertEquals(5, $collection->count());
    }

    public function testCountArrayOfArray(): void
    {
        $collection = new Collection([
            ['id' => 3, 'name' => 'John'],
            ['id' => 7, 'name' => 'Jan'],
        ]);
        $this->assertEquals(2, $collection->count());
    }
}
