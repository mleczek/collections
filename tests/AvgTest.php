<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class AvgTest extends TestCase
{
    public function testAvgFromNumbers(): void
    {
        $collection = collection([1, 2, 9]);
        $this->assertEquals(4, $collection->avg());
    }

    public function testAvgByObjectProperty(): void
    {
        $collection = new Collection([
            ['value' => 4],
            ['value' => 4],
            ['value' => 7],
        ]);

        $result = $collection->avg(fn($x) => $x['value']);
        $this->assertEquals(5, $result);
    }

    public function testAvgZeroWhenNoItems(): void
    {
        $collection = new Collection([]);
        $this->assertEquals(0, $collection->avg());
    }

    public function testAvgNonNumericValues(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $collection = new Collection([2, 'a']);
        $collection->avg();
    }
}
