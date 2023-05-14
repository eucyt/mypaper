service_name := laravel

install:
	cp laravel/.env.local laravel/.env
	docker-compose up -d --build
	docker-compose exec $(service_name) composer install
	docker-compose exec $(service_name) php artisan key:generate
	make cache
	make migrate-fresh
	sudo chmod -R 777 laravel/storage
	-sudo rm laravel/public/storage
	docker-compose exec $(service_name) php artisan storage:link
up:
	docker-compose up -d
down:
	docker-compose down
destroy:
	docker-compose down --rmi all --volumes --remove-orphans
	- sudo rm -r docker/minio/config
	- sudo rm -r docker/minio/data
	- sudo rm laravel/.env
	- sudo rm -r laravel/node_modules
	- sudo rm -r laravel/vendor

cache:
	docker-compose exec $(service_name) php artisan cache:clear
	docker-compose exec $(service_name) php artisan config:clear
	docker-compose exec $(service_name) php artisan route:clear
	docker-compose exec $(service_name) php artisan view:clear
	docker-compose exec $(service_name) composer dump-autoload
	docker-compose exec $(service_name) php artisan clear-compiled
	docker-compose exec $(service_name) php artisan optimize
	docker-compose exec $(service_name) php artisan config:cache

migrate:
	docker-compose exec $(service_name) php artisan migrate
migrate-rollback:
	docker-compose exec $(service_name) php artisan migrate:rollback
migrate-fresh:
	docker-compose exec $(service_name) composer dump-autoload
	docker-compose exec $(service_name) php artisan migrate:fresh --seed

test:
	docker-compose exec $(service_name) php artisan test

bash:
	docker-compose exec $(service_name) bash