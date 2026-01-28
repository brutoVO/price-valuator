.PHONY: up down shell init test test-back test-front

up:
	docker compose up -d

down:
	docker compose down

shell:
	docker compose exec app bash

# Instala Symfony Skeleton si el directorio está vacío (excepto docker/)
init:
	docker compose build
	docker compose up -d
	docker compose exec app composer create-project symfony/skeleton:"6.4.*" tmp_sf
	docker compose exec app cp -rT tmp_sf/ .
	docker compose exec app rm -rf tmp_sf
	@echo "Symfony initialized! Run 'make up' to ensure services are running."

test: test-back test-front

test-back:
	docker compose exec app bin/phpunit

test-front:
	docker compose exec app npm test