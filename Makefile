.PHONY: build deps composer-install composer-update composer reload start stop destroy rebuild start-local

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

build: deps start

deps: composer-install

# 🐘 Composer
composer-install: CMD=install
composer-update: CMD=update
composer composer-install composer-update:
	@docker run --rm --interactive --volume $(current-dir):/app --user $(id -u):$(id -g) \
		clevyr/prestissimo $(CMD) \
			--ignore-platform-reqs \
			--no-ansi \
			--no-interaction

reload:
	@docker-compose exec php-fpm kill -USR2 1
	@docker-compose exec nginx nginx -s reload

# 🐳 Docker Compose
start: CMD=up -d
stop: CMD=stop
destroy: CMD=down

start stop destroy:
	@docker-compose $(CMD)

# 🐳 Docker Compose sh
sh_nginx: CMD=nginx
sh_php: CMD=php
sh_nginx sh_php:
	@docker exec -it ${CMD} /bin/sh

rebuild:
	docker-compose build --pull --force-rm --no-cache
	make deps
	make start

prepare-local:
	curl -sS https://get.symfony.com/cli/installer | bash

start-local:
	symfony serve --dir=src/Integration/public --port=8030 -d --no-tls --force-php-discovery

stop-local:
	symfony server:stop --dir=src/Integration/public
