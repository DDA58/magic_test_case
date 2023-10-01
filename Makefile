.DEFAULT_GOAL := help
.PHONY: help
help:
	@echo "Hello"
	@echo "Did you make command 'init'?"

init: run_copy_env run_down_project run_build_up_d_project run_composeri

phpfix: run_phpfix
composeri: run_composeri

run_phpfix:
	docker-compose exec app ./vendor/bin/phpcbf

run_psalm:
	docker-compose exec app ./vendor/bin/psalm

run_composeri:
	docker-compose exec app composer install

run_copy_env:
	cp .env .env.local

run_down_project:
	docker-compose down

run_build_up_d_project:
	docker-compose up --build -d
