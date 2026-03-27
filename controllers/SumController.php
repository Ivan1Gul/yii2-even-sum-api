<?php

declare(strict_types=1);

namespace app\controllers;

use app\dto\NumbersRequestDto;
use app\http\requests\SumRequest;
use app\http\responses\SumResponse;
use app\services\interfaces\SumCalculatorInterface;
use Yii;
use yii\rest\Controller;

final class SumController extends Controller
{
    public function __construct(
        string $id,
        \yii\base\Module $module,
        private readonly SumCalculatorInterface $sumCalculator,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionCalculate(): array
    {
        $request = new SumRequest(Yii::$app->request->getBodyParams());
        $dto      = new NumbersRequestDto($request->numbers);
        $response = new SumResponse($this->sumCalculator->calculate($dto));

        Yii::$app->response->setStatusCode(200);

        return $response->toArray();
    }
}