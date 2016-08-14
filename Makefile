.PHONY: up down build serve migrate clearcache

up:
	docker-compose config -q && \
	docker-compose up --force-recreate

down:
	docker-compose config -q && \
	docker-compose down -v

build:
	docker-compose config -q && \
	docker-compose build --pull

serve:
	docker-compose config -q && \
	docker-compose exec laravel php artisan serve --host 0.0.0.0

migrate:
	docker-compose config -q && \
	docker-compose exec laravel php artisan migrate:refresh

clearcache:
	docker-compose exec laravel php artisan cache:clear; \
	docker-compose exec laravel php artisan clear-compiled; \
	docker-compose exec laravel php artisan config:clear; \
	docker-compose exec laravel php artisan route:clear; \
	docker-compose exec laravel php artisan view:clear; \
	docker-compose exec laravel php artisan optimize; \
	true
