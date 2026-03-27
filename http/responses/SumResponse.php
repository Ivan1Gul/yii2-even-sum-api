<?php

declare(strict_types=1);

namespace app\http\responses;

final class SumResponse
{
    public function __construct(
        public readonly int $sum
    ) {}

    public function toArray(): array
    {
        return [
            'data'  => ['sum' => $this->sum],
            'error' => null,
            'meta'  => ['success' => true],
        ];
    }
}