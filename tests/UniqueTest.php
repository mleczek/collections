<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class UniqueTest extends TestCase
{
    public function testUnique(): void
    {
        $collection = new Collection([3, 2, 3, 1, 1]);
        $result = $collection->unique()->toArray();
        $this->assertEquals([3, 2, 1], $result);
    }

    public function testUniqueUseFirstOccurrence(): void
    {
        $collection = new Collection([
            'a' => 3,
            'b' => 2,
            'd' => 3,
            'c' => 1,
            'e' => 1
        ]);

        $result = $collection->unique()->toArray();
        $this->assertEquals(['a' => 3, 'b' => 2, 'c' => 1], $result);
    }

    public function testUniqueByObjectProperty(): void
    {
        $collection = new Collection([
            ['a' => 3, 'b' => 1],
            ['a' => 3, 'b' => 2],
            ['a' => 4, 'b' => 3],
        ]);

        $result = $collection->unique(fn($x) => $x['a'])->toArray();
        $expected = [
            ['a' => 3, 'b' => 1],
            ['a' => 4, 'b' => 3],
        ];

        $this->assertEquals($expected, $result);
    }
}
