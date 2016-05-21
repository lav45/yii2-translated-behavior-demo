all: install

force_update: reinstall_db install

reinstall_db:
	rm -f common/data/db.sqlite

install: clear composer migrate
	php yii user/create admin admin

composer:
	composer install --prefer-dist --no-interaction

migrate:
	php yii migrate/up all --interactive=0
	php yii cache/flush-schema --interactive=0

clear:
	php yii cache/flush-all
	rm -rf */web/assets/*
	rm -rf */runtime/*
