<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class KeysTest extends TestCase
{
    public function testKeysEmptyArray(): void
    {
        $collection = new Collection([]);
        $this->assertEquals([], $collection->keys());
    }

    public function testKeysIndexedArray(): void
    {
        $collection = new Collection([1, 5, 2]);
        $this->assertEquals([0, 1, 2], $collection->keys());
    }

    public function testKeysAssociativeArray(): void
    {
        $collection = new Collection([1 => 'a', 'b' => 5, 2 => 'c']);
        $this->assertEquals([1, 'b', 2], $collection->keys());
    }
}
