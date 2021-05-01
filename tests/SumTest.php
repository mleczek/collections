<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class SumTest extends TestCase
{
    public function testSum(): void
    {
        $collection = collection([1, 4, 3]);
        $this->assertEquals(8, $collection->sum());
    }

    public function testSumByObjectProperty(): void
    {
        $collection = new Collection([
            ['value' => 5],
            ['value' => 2.3],
            ['value' => 4],
        ]);

        $result = $collection->sum(fn($x) => $x['value']);
        $this->assertEqualsWithDelta(11.3, $result, 0.01);
    }
}
