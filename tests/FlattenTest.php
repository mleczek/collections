<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class FlattenTest extends TestCase
{
    public function testFlattenArrayOfArray(): void
    {
        $collection = new Collection([[1, 2], [3, 4, 5]]);
        $this->assertEquals(
            [1, 2, 3, 4, 5],
            $collection->flatten()->toArray()
        );
    }

    public function testFlattenWithDuplicatedValues(): void
    {
        $collection = new Collection([[1, 2], [3, 2]]);
        $this->assertEquals(
            [1, 2, 3, 2],
            $collection->flatten()->toArray()
        );
    }

    public function testFlattenKeyValuePairs(): void
    {
        $collection = new Collection(['a' => 1, 'b' => 2]);
        $this->assertEquals(
            ['a' => 1, 'b' => 2],
            $collection->flatten()->toArray()
        );
    }

    public function testFlattenMixed(): void
    {
        $collection = new Collection(['a' => [7, 4], 'b' => 2]);
        $this->assertEquals(
            [7, 4, 'b' => 2],
            $collection->flatten()->toArray()
        );
    }

    public function testFlattenArrayOfKeyValuePairs(): void
    {
        $collection = new Collection([
            ['a' => 1, 'b' => 2],
            ['c' => 3],
        ]);

        $this->assertEquals(
            ['a' => 1, 'b' => 2, 'c' => 3],
            $collection->flatten()->toArray()
        );
    }
}
