.PHONY: up down shell install test test-back test-front assets watch build

-include .env.local
export

up:
	docker compose up -d

down:
	docker compose down

shell:
	docker compose exec app bash

install:
	docker compose build
	docker compose up -d
	docker compose exec app composer install
	docker compose exec app npm install --legacy-peer-deps
	docker compose exec app npm run build
	docker compose exec app php bin/console cache:clear
	docker compose exec app php bin/console cache:clear --env=test
	@echo "Project installed! Open http://localhost:8080"

assets:
	docker compose exec app npm run dev

watch:
	docker compose exec app npm run watch

build:
	docker compose exec app npm run build

test: test-back test-front

test-back:
	docker compose exec app env APP_ENV=test bin/phpunit

test-front:
	docker compose exec app npm test
