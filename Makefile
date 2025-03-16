phpunit-test:
	cp .env.testing.example .env.testing
	php artisan key:generate --env=testing
	XDEBUG_MODE=coverage php -d short_open_tag=off vendor/bin/phpunit
