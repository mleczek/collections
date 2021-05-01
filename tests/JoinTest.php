<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class JoinTest extends TestCase
{
    public function testJoin(): void
    {
        $collection = collection([3, 9, 4]);
        $result = $collection->join(', ');
        $this->assertEquals('3, 9, 4', $result);
    }
}
