<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class WhereInTest extends TestCase
{
    public function testWhereIn(): void
    {
        $collection = new Collection([1, 5, 2]);
        $result = $collection->whereIn(fn($x) => $x, [3, 5, 2])->toArray();
        $this->assertEquals([5, 2], $result);
    }

    public function testWhereInByKey(): void
    {
        $collection = new Collection([3, 5, 2]);
        $result = $collection->whereIn(fn($val, $key) => $key, [0, 2])->toArray();
        $this->assertEquals([3, 2], $result);
    }

    public function testWhereInKeepsAssociativeKeys(): void
    {
        $collection = new Collection(['a' => 3, 'b' => 5, 'c' => 2]);
        $result = $collection->whereIn(
            fn($val, $key) => "$key:$val",
            ['c:2', 'a:3', 'd:8']
        )->toArray();

        $this->assertEquals(['a' => 3, 'c' => 2], $result);
    }

    public function testWhereInStrictCheck(): void {
        $collection = new Collection([3, '5', 2, '4']);
        $result = $collection->whereIn(fn($val) => $val, [3, 5, '4'])->toArray();
        $this->assertEquals([3, '4'], $result);
    }
}
