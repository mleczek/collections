<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class MergeTest extends TestCase
{
    public function testMergeArray(): void
    {
        $collection = new Collection([1]);
        $result = $collection->merge([2])->toArray();
        $this->assertEquals([1, 2], $result);
    }

    public function testMergeCollection(): void
    {
        $first = new Collection([1]);
        $second = new Collection([2]);

        $result = $first->merge($second)->toArray();
        $this->assertEquals([1, 2], $result);
    }

    public function testMergeIndexedToIndexed(): void
    {
        $first = new Collection([1, 2]);
        $second = new Collection([2, 3]);

        $result = $first->merge($second)->toArray();
        $this->assertEquals([1, 2, 2, 3], $result);
    }

    public function testMergeIndexedToAssociative(): void
    {
        $first = new Collection(['a' => 1, 2 => 'b']);
        $second = new Collection([2, 3]);

        $result = $first->merge($second)->toArray();
        $this->assertEquals(['a' => 1, 2 => 'b', 2, 3], $result);
    }

    public function testMergeAssociativeToIndexed(): void
    {
        $first = new Collection([2, 3]);
        $second = new Collection(['a' => 1, 2 => 'b']);

        $result = $first->merge($second)->toArray();
        $this->assertEquals([2, 3, 'a' => 1, 2 => 'b'], $result);
    }

    public function testMergeAssociativeToAssociative(): void
    {
        $first = new Collection(['a' => 1, 2 => 'b']);
        $second = new Collection([2 => 'c', 'd' => 3]);

        $result = $first->merge($second)->toArray();
        $this->assertEquals(['a' => 1, 2 => 'c', 'd' => 3], $result);
    }
}
