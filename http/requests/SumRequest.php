<?php

declare(strict_types=1);

namespace app\http\requests;

use yii\web\BadRequestHttpException;

final class SumRequest
{
    /** @var int[] */
    public readonly array $numbers;

    /**
     * @throws BadRequestHttpException
     */
    public function __construct(array $body)
    {
        if (!array_key_exists('numbers', $body)) {
            throw new BadRequestHttpException('Field "numbers" is required.');
        }

        if (!is_array($body['numbers'])) {
            throw new BadRequestHttpException('Field "numbers" must be an array.');
        }

        if (empty($body['numbers'])) {
            throw new BadRequestHttpException('Field "numbers" must not be empty.');
        }

        foreach ($body['numbers'] as $index => $value) {
            if (!is_int($value)) {
                throw new BadRequestHttpException(
                    sprintf('Element at index %d must be an integer, got %s.', $index, gettype($value))
                );
            }
        }

        $this->numbers = $body['numbers'];
    }
}