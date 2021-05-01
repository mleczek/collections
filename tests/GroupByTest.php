<?php


namespace Mleczek\Collections\Tests;


use Mleczek\Collections\Collection;
use PHPUnit\Framework\TestCase;

class GroupByTest extends TestCase
{
    public function testGroupBy(): void
    {
        $collection = new Collection([
            ['gender' => 'male', 'name' => 'Jan'],
            ['gender' => 'male', 'name' => 'Kuba'],
            ['gender' => 'female', 'name' => 'Monika'],
        ]);

        $result = $collection->groupBy(fn($x) => $x['gender'])->toArray();
        $expected = [
            'male' => [
                ['gender' => 'male', 'name' => 'Jan'],
                ['gender' => 'male', 'name' => 'Kuba'],
            ],
            'female' => [
                ['gender' => 'female', 'name' => 'Monika'],
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGroupByKeyValuePairs(): void
    {
        $collection = new Collection([
            2 => ['gender' => 'male', 'name' => 'Jan'],
            5 => ['gender' => 'male', 'name' => 'John'],
        ]);

        $result = $collection->groupBy(fn($x) => $x['gender'])->toArray();
        $expected = [
            'male' => [
                2 => ['gender' => 'male', 'name' => 'Jan'],
                5 => ['gender' => 'male', 'name' => 'John'],
            ],
        ];

        $this->assertEquals($expected, $result);
    }
}
