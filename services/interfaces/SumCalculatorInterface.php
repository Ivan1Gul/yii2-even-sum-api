<?php

declare(strict_types=1);

namespace app\services\interfaces;

use app\dto\NumbersRequestDto;

interface SumCalculatorInterface
{
    public function calculate(NumbersRequestDto $dto): int;
}