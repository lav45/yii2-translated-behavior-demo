all: install

install: clear composer migrate
	find -name '.*' ! -name '.' -exec rm -rf {} +

composer:
	composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

migrate:
	php yii migrate/up all --interactive=0
	php yii cache/flush-schema --interactive=0

clear:
	php yii cache/flush-all
	rm -rf */web/assets/*
	rm -rf */runtime/*
