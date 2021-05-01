<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    public function testMapWithLambda(): void
    {
        $collection = new Collection([1, 2, 3]);
        $result = $collection->map(fn($x) => $x * 2)->toArray();
        $this->assertEquals([2, 4, 6], $result);
    }

    public function testMapWithFunction(): void
    {
        $collection = new Collection([8, 4, 20]);
        $result = $collection->map(function ($x) {
            return $x / 2;
        })->toArray();

        $this->assertEquals([4, 2, 10], $result);
    }

    public function testMapKeepKeys(): void
    {
        $collection = new Collection(['a' => 2, 'b' => 5]);
        $result = $collection->map(fn($x) => $x * 2)->toArray();

        $this->assertEquals(['a' => 4, 'b' => 10], $result);
    }

    public function testMapKeyValue(): void
    {
        $collection = new Collection([0 => 2, 1 => 5]);
        $result = $collection->map(fn($val, $key) => $val + $key)->toArray();

        $this->assertEquals([0 => 2, 1 => 6], $result);
    }
}
