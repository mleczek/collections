<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class EachTest extends TestCase
{
    public function testEach(): void
    {
        $collection = new Collection([1, 2, 9, 5, 1]);
        $this->expectOutputString('12951');
        $collection->each(fn($x) => printf($x));
    }

    public function testEachWithKeys(): void
    {
        $collection = new Collection([
            'a' => 1,
            'b' => 2,
        ]);

        $this->expectOutputString('a:1b:2');
        $collection->each(fn($val, $key) => printf("$key:$val"));
    }
}
