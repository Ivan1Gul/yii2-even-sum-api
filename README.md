# Yii2 Even Sum API

REST API на **Yii2 / PHP 8.3**, takes an array of integers and returns the sum of the even ones. / приймає масив цілих чисел і повертає суму парних.

## Quick start / Швидкий старт
```bash
git clone <repo-url> && cd <project>
docker-compose build
docker-compose up -d
```

## Usage / Використання
```bash
curl -X POST http://localhost:8000/sum \
  -H "Content-Type: application/json" \
  -d '{"numbers": [1, 2, 3, 4, 5, 6]}'
```

**Successful response / Успішна відповідь (200):**
```json
{
  "data":  { "sum": 12 },
  "error": null,
  "meta":  { "success": true }
}
```

**Validation error / Помилка валідації (400):**
```json
{
  "data":  null,
  "error": { "message": "Field \"numbers\" is required.", "code": 400 },
  "meta":  { "success": false }
}
```

## Tests and static analysis / Тести та статичний аналіз
Linux/macOS
```bash
make test   # PHPUnit
make stan   # PHPStan level 8
```

Windows
```bash
docker-compose exec php ./vendor/bin/phpunit --colors=always   # PHPUnit
docker-compose exec php ./vendor/bin/phpstan analyse   # PHPStan level 8
```

## Project structure / Структура проекту
```
components/ApiErrorHandler.php          — single JSON error handler / єдиний JSON-обробник помилок
controllers/SumController.php           — HTTP entry point / точка входу HTTP
dto/NumbersRequestDto.php               — DTO between layers / DTO між шарами
http/
  requests/SumRequest.php               — parsing and validating the incoming request / парсинг та валідація вхідного запиту
  responses/SumResponse.php             — единый формат ответа
services/
  interfaces/
    NumberFilterInterface.php
    SumCalculatorInterface.php
  EvenNumberFilter.php                  — filtering even numbers / фільтрація парних чисел
  EvenSumCalculator.php                 — calculating the amount through a filter / підрахунок суми через фільтр
tests/unit/
  http/SumRequestTest.php
  services/EvenNumberFilterTest.php
  services/EvenSumCalculatorTest.php
.github/workflows/ci.yml                — GitHub Actions CI
phpunit.xml
phpstan.neon
Makefile
```