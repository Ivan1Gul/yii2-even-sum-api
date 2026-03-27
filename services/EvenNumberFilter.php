<?php

declare(strict_types=1);

namespace app\services;

use app\services\interfaces\NumberFilterInterface;

final class EvenNumberFilter implements NumberFilterInterface
{
    /**
     * @param int[] $numbers
     * @return int[]
     */
    public function filter(array $numbers): array
    {
        return array_values(
            array_filter($numbers, static fn(int $n): bool => $n % 2 === 0)
        );
    }
}