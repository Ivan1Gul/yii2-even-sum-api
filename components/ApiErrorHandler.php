<?php

declare(strict_types=1);

namespace app\components;

use Throwable;
use yii\web\ErrorHandler;
use yii\web\HttpException;
use yii\web\Response;

class ApiErrorHandler extends ErrorHandler
{
    public function renderException($exception): void
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $statusCode = match (true) {
        $exception instanceof HttpException => $exception->statusCode,
            default => 500,
        };

        \Yii::$app->response->setStatusCode($statusCode);
        \Yii::$app->response->data = [
            'data'  => null,
            'error' => [
                'message' => YII_DEBUG
                    ? $exception->getMessage()
                    : ($statusCode < 500 ? $exception->getMessage() : 'Internal Server Error'),
                'code' => $statusCode,
            ],
            'meta' => ['success' => false],
        ];

        \Yii::$app->response->send();
    }
}