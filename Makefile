.PHONY: up down build test stan

up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build --no-cache

test:
	docker-compose exec php ./vendor/bin/phpunit --colors=always

stan:
	docker-compose exec php ./vendor/bin/phpstan analyse

logs:
	docker-compose logs -f php

shell:
	docker-compose exec php bash