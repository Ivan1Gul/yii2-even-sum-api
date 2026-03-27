<?php

declare(strict_types=1);

namespace tests\unit\services;

use app\dto\NumbersRequestDto;
use app\services\EvenNumberFilter;
use app\services\EvenSumCalculator;
use PHPUnit\Framework\TestCase;

final class EvenSumCalculatorTest extends TestCase
{
    private EvenSumCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new EvenSumCalculator(new EvenNumberFilter());
    }

    public function testMixedNumbers(): void
    {
        self::assertSame(12, $this->calculator->calculate(new NumbersRequestDto([1, 2, 3, 4, 5, 6])));
    }

    public function testAllOddReturnsZero(): void
    {
        self::assertSame(0, $this->calculator->calculate(new NumbersRequestDto([1, 3, 5])));
    }

    public function testAllEven(): void
    {
        self::assertSame(6, $this->calculator->calculate(new NumbersRequestDto([2, 4])));
    }

    public function testEmptyArrayReturnsZero(): void
    {
        self::assertSame(0, $this->calculator->calculate(new NumbersRequestDto([])));
    }

    public function testNegativeEvenNumbers(): void
    {
        self::assertSame(2, $this->calculator->calculate(new NumbersRequestDto([-2, -3, 4])));
    }

    public function testZeroCountedAsEven(): void
    {
        self::assertSame(0, $this->calculator->calculate(new NumbersRequestDto([0, 1, 3])));
    }
}