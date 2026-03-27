<?php

declare(strict_types=1);

namespace app\services\interfaces;

interface NumberFilterInterface
{
    /** @param int[] $numbers */
    public function filter(array $numbers): array;
}