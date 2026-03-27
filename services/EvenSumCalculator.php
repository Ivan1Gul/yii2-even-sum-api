<?php

declare(strict_types=1);

namespace app\services;

use app\dto\NumbersRequestDto;
use app\services\interfaces\NumberFilterInterface;
use app\services\interfaces\SumCalculatorInterface;

final class EvenSumCalculator implements SumCalculatorInterface
{
    public function __construct(
        private readonly NumberFilterInterface $filter
    ) {}

    public function calculate(NumbersRequestDto $dto): int
    {
        return array_sum($this->filter->filter($dto->numbers));
    }
}