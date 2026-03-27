<?php

declare(strict_types=1);

namespace app\dto;

final class NumbersRequestDto
{
    /** @param int[] $numbers */
    public function __construct(
        public readonly array $numbers
    ) {}
}