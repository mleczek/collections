<?php


namespace Mleczek\Collections\Tests;


use PHPUnit\Framework\TestCase;

class ToArrayTest extends TestCase
{
    public function testToArray(): void
    {
        $array = [3, 8, 4, 5];
        $collection = collection($array);
        $this->assertEquals($array, $collection->toArray());
    }
}
