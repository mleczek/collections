<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class SkipTest extends TestCase
{
    public function testSkipOne(): void
    {
        $collection = new Collection([1, 4, 6]);
        $this->assertEquals([4, 6], $collection->skip()->toArray());
    }

    public function testSkipMultiple(): void
    {
        $collection = new Collection([1, 4, 6]);
        $this->assertEquals([6], $collection->skip(2)->toArray());
    }

    public function testSkipAboveCountReturnsEmptyCollection(): void
    {
        $collection = new Collection([1, 4, 6]);
        $this->assertEquals([], $collection->skip(5)->toArray());
    }
}
