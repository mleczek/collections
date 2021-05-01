<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class WhereTest extends TestCase
{
    public function testWhere(): void
    {
        $collection = new Collection([1, 5, 2]);
        $result = $collection->where(fn($x) => $x < 3)->toArray();
        $this->assertEquals([1, 2], $result);
    }

    public function testWhereByKey(): void
    {
        $collection = new Collection([3, 5, 2]);
        $result = $collection->where(fn($val, $key) => $key % 2 === 0)->toArray();
        $this->assertEquals([3, 2], $result);
    }

    public function testWhereKeepsAssociativeKeys(): void
    {
        $collection = new Collection(['a' => 3, 'b' => 5, 'c' => 2]);
        $result = $collection->where(fn($val, $key) => $val < 4)->toArray();
        $this->assertEquals(['a' => 3, 'c' => 2], $result);
    }
}
