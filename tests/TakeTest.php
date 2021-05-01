<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class TakeTest extends TestCase
{
    public function testTakeOne(): void
    {
        $collection = new Collection([1, 8, 4]);
        $result = $collection->take()->toArray();
        $this->assertEquals([1], $result);
    }

    public function testTakeMultiple(): void
    {
        $collection = new Collection([1, 8, 4]);
        $result = $collection->take(2)->toArray();
        $this->assertEquals([1, 8], $result);
    }

    public function testTakeMultipleAboveCount(): void
    {
        $collection = new Collection([1, 8, 4]);
        $result = $collection->take(5)->toArray();
        $this->assertEquals([1, 8, 4], $result);
    }
}
