<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class MinTest extends TestCase
{
    public function testMinFromNumbers(): void
    {
        $collection = new Collection([6, 2, 9]);
        $this->assertEquals(2, $collection->min());
    }

    public function testMinByObjectProperty(): void
    {
        $collection = new Collection([
            ['value' => 4],
            ['value' => 7],
            ['value' => 4],
        ]);

        $result = $collection->min(fn($x) => $x['value']);
        $this->assertEquals(4, $result);
    }

    public function testMinNullWhenNoItems(): void
    {
        $collection = new Collection([]);
        $this->assertEquals(null, $collection->min());
    }
}
