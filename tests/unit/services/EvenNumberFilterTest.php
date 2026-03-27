<?php

declare(strict_types=1);

namespace tests\unit\services;

use app\services\EvenNumberFilter;
use PHPUnit\Framework\TestCase;

final class EvenNumberFilterTest extends TestCase
{
    private EvenNumberFilter $filter;

    protected function setUp(): void
    {
        $this->filter = new EvenNumberFilter();
    }

    public function testFiltersEvenNumbers(): void
    {
        self::assertSame([2, 4, 6], $this->filter->filter([1, 2, 3, 4, 5, 6]));
    }

    public function testAllOddReturnsEmpty(): void
    {
        self::assertSame([], $this->filter->filter([1, 3, 5]));
    }

    public function testAllEvenReturnsAll(): void
    {
        self::assertSame([2, 4], $this->filter->filter([2, 4]));
    }

    public function testEmptyArrayReturnsEmpty(): void
    {
        self::assertSame([], $this->filter->filter([]));
    }

    public function testNegativeEvenIncluded(): void
    {
        self::assertSame([-4, 2], $this->filter->filter([-4, -3, 2]));
    }

    public function testZeroIsEven(): void
    {
        self::assertSame([0], $this->filter->filter([0, 1, 3]));
    }
}