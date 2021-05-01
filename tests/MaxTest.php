<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class MaxTest extends TestCase
{
    public function testMaxFromNumbers(): void
    {
        $collection = new Collection([6, 2, 9]);
        $this->assertEquals(9, $collection->max());
    }

    public function testMaxByObjectProperty(): void
    {
        $collection = new Collection([
            ['value' => 4],
            ['value' => 7],
            ['value' => 4],
        ]);

        $result = $collection->max(fn($x) => $x['value']);
        $this->assertEquals(7, $result);
    }

    public function testMaxNullWhenNoItems(): void
    {
        $collection = new Collection([]);
        $this->assertEquals(null, $collection->max());
    }
}
