<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class IsAssociativeTest extends TestCase
{
    public function testIsAssociative(): void
    {
        $collection = new Collection(['a' => 1, 'b' => 3]);
        $this->assertTrue($collection->isAssociative());
    }

    public function testIsAssociativePartially(): void
    {
        $collection = new Collection([1, 5, 'b' => 3]);
        $this->assertTrue($collection->isAssociative());
    }

    public function testIsNotAssociative(): void
    {
        $collection = new Collection(['a', 1, [1, 3]]);
        $this->assertFalse($collection->isAssociative());
    }
}
