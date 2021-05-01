<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class KeyByTest extends TestCase
{
    public function testKeyBy(): void
    {
        $collection = new Collection([
            ['id' => 5, 'name' => 'Jan'],
            ['id' => 3, 'name' => 'John'],
        ]);

        $result = $collection->keyBy(fn($x) => $x['id'])->toArray();
        $expected = [
            5 => ['id' => 5, 'name' => 'Jan'],
            3 => ['id' => 3, 'name' => 'John'],
        ];

        $this->assertEquals($expected, $result);
    }

    public function testKeyByThrowsOnDuplicatedKey(): void
    {
        $collection = new Collection([
            ['id' => 3, 'name' => 'Jan'],
            ['id' => 3, 'name' => 'John'],
        ]);

        $this->expectException(InvalidArgumentException::class);
        $collection->keyBy(fn($x) => $x['id']);
    }
}
