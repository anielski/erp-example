build:
	composer update && php bin/console doctrine:migrations:migrate

all: build
	symfony server:start

run:
	symfony server:start

### Warrnin: don't run it if you not run build first
fixtures:
	bin/console doctrine:fixtures:load --append

test:
	bin/phpunit