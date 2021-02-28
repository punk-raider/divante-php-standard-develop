.PHONY: start
start: erase up ## Clean current environment, recreate dependencies and spin up again

.PHONY: stop
stop: ## Stop environment
		docker-compose stop

.PHONY: erase
erase: ## Stop and delete containers, clean volumes
		docker-compose stop
		docker-compose rm -v -f

.PHONY: composer-install
composer-install: ## Install project dependencies
		docker-compose run --rm php sh -lc 'composer install'

.PHONY: composer-update
composer-update: ## Update project dependencies
		docker-compose run --rm php sh -lc 'composer update'

.PHONY: up
up: ## spin up environment
		docker-compose -f docker-compose.yml -f docker-compose.mock.yml up -d

.PHONY: tests
tests-all: ## execute project tests
		docker-compose exec php sh -lc "./vendor/bin/phpunit"

.PHONY: tests-coverage
tests-coverage: ## execute project tests code coverage generation
		docker-compose exec php sh -lc "php vendor/bin/phpunit tests/Unit --coverage-html tests/CodeCoverage"

.PHONY: phpstan
phpstan: ## executes php stan
		docker-compose run --rm php sh -lc './vendor/bin/phpstan analyse'

.PHONY: phpcs
phpcs: ## executes php cs
		docker-compose run --rm php sh -lc './vendor/bin/phpcs'

.PHONY: phpcbf
phpcbf: ## executes php cs fixer
		docker-compose run --rm php sh -lc './vendor/bin/phpcbf'

.PHONY: cq
cq: phpcbf phpcs-fixer phpstan phpcs

.PHONY: phpcs-fixer
phpcs-fixer:
		docker-compose run --rm php sh -lc './vendor/bin/php-cs-fixer fix ./src/ --rules=blank_line_before_statement'
