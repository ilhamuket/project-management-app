# Project Management Makefile

# Build and start containers
up:
	docker-compose up -d

# Build containers
build:
	docker-compose build

# Stop containers
down:
	docker-compose down

# View logs
logs:
	docker-compose logs -f

# Access app container
shell:
	docker-compose exec app bash

# Install npm dependencies
npm-install:
	docker-compose exec app npm install

# Build assets
npm-build:
	docker-compose exec app npm run build

# Watch assets
npm-dev:
	docker-compose exec app npm run dev

# Install Laravel and setup Preline
install:
	docker-compose exec app composer create-project laravel/laravel tmp
	docker-compose exec app cp -r tmp/* .
	docker-compose exec app cp -r tmp/.* . 2>/dev/null || true
	docker-compose exec app rm -rf tmp
	docker-compose exec app chmod +x scripts/setup-env.sh
	docker-compose exec app ./scripts/setup-env.sh
	docker-compose exec app npm install

# Start Laravel server
serve:
	docker-compose exec app php artisan serve --host=0.0.0.0 --port=8000

# Test database connection
test-db:
	docker-compose exec app php artisan migrate:status

# Run migrations
migrate:
	docker-compose exec app php artisan migrate

# Clear cache
cache-clear:
	docker-compose exec app php artisan cache:clear
	docker-compose exec app php artisan config:clear
	docker-compose exec app php artisan route:clear

# Fresh install
fresh: down build up install serve

# Help
help:
	@echo "Available commands:"
	@echo "  make up          - Start containers"
	@echo "  make build       - Build containers"
	@echo "  make down        - Stop containers"
	@echo "  make logs        - View logs"
	@echo "  make shell       - Access app container"
	@echo "  make install     - Install Laravel"
	@echo "  make test-db     - Test database connection"
	@echo "  make migrate     - Run migrations"
	@echo "  make cache-clear - Clear cache"
	@echo "  make serve       - Start Laravel server"
	@echo "  make npm-install - Install npm dependencies"
	@echo "  make npm-build   - Build assets"
	@echo "  make npm-dev     - Watch assets development"
	@echo "  make fresh       - Fresh install"