<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class ChunkTest extends TestCase
{
    public function testChunk(): void
    {
        $collection = new Collection([1, 2, 9, 9, 2]);
        $this->assertEquals([[1, 2], [9, 9], [2]], $collection->chunk(2)->toArray());
    }

    public function testChunkKeyValueArray(): void
    {
        $collection = new Collection([
            'a' => 1,
            'b' => 2,
            'c' => 3,
        ]);

        $this->assertEquals([['a' => 1, 'b' => 2], ['c' => 3]], $collection->chunk(2)->toArray());
    }
}
