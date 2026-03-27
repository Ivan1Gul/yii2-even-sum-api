<?php

declare(strict_types=1);

namespace tests\unit\http;

use app\http\requests\SumRequest;
use PHPUnit\Framework\TestCase;
use yii\web\BadRequestHttpException;

final class SumRequestTest extends TestCase
{
    public function testValidInput(): void
    {
        $req = new SumRequest(['numbers' => [1, 2, 3]]);
        self::assertSame([1, 2, 3], $req->numbers);
    }

    public function testMissingFieldThrows(): void
    {
        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage('"numbers" is required');
        new SumRequest([]);
    }

    public function testNonArrayThrows(): void
    {
        $this->expectException(BadRequestHttpException::class);
        new SumRequest(['numbers' => 'not-array']);
    }

    public function testEmptyArrayThrows(): void
    {
        $this->expectException(BadRequestHttpException::class);
        new SumRequest(['numbers' => []]);
    }

    public function testNonIntegerElementThrows(): void
    {
        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage('index 1');
        new SumRequest(['numbers' => [1, 'abc', 3]]);
    }
}