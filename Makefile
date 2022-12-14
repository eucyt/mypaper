service_name := laravel

install:
	cp laravel/.env.local laravel/.env
	sudo docker-compose up -d --build
	sudo docker-compose exec $(service_name) composer install
	sudo docker-compose exec $(service_name) php artisan key:generate
	make cache
	make migrate-fresh
	sudo chmod -R 777 laravel/storage
	-sudo rm laravel/public/storage
	sudo docker-compose exec $(service_name) php artisan storage:link
up:
	sudo docker-compose up -d
down:
	sudo docker-compose down
destroy:
	sudo docker-compose down --rmi all --volumes --remove-orphans
	- sudo rm laravel/.env
	- sudo rm -r laravel/node_modules
	- sudo rm -r laravel/vendor

cache:
	sudo docker-compose exec $(service_name) php artisan cache:clear
	sudo docker-compose exec $(service_name) php artisan config:clear
	sudo docker-compose exec $(service_name) php artisan route:clear
	sudo docker-compose exec $(service_name) php artisan view:clear
	sudo docker-compose exec $(service_name) composer dump-autoload
	sudo docker-compose exec $(service_name) php artisan clear-compiled
	sudo docker-compose exec $(service_name) php artisan optimize
	sudo docker-compose exec $(service_name) php artisan config:cache

migrate:
	sudo docker-compose exec $(service_name) php artisan migrate
migrate-rollback:
	sudo docker-compose exec $(service_name) php artisan migrate:rollback
migrate-fresh:
	sudo docker-compose exec $(service_name) composer dump-autoload
	sudo docker-compose exec $(service_name) php artisan migrate:fresh --seed

test:
	sudo docker-compose exec $(service_name) php artisan test

bash:
	sudo docker-compose exec $(service_name) bash