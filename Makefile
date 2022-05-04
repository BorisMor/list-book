.DEFAULT_GOAL := start

start:
	docker-compose up -d

stop:
	docker-compose down --remove-orphans

logs:
	docker-compose logs -f

build:
	docker-compose build

app:
	docker-compose run --rm php-cli bash

db:
	docker-compose exec db bash

php:
	docker-compose exec php bash

app-init:
	docker-compose run --rm php-cli php init

app-flush-cache:
	docker-compose run --rm php-cli php yii cache/flush-all

composer-install:
	docker-compose run --rm php-cli composer install

migrate-up:
	docker-compose run --rm php-cli php yii migrate/up

migrate-down:
	docker-compose run --rm php-cli php yii migrate/down
