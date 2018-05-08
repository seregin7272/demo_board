docker-up: memory perm
	docker-compose up -d

docker-down:
	docker-compose down

docker-build: memory
	docker-compose up --build -d

v-php:
	docker exec app_php-cli_1 php -v

perm:
	sudo chown ${USER}:${USER} resources -R
	sudo chmod 777 resources -R
	sudo chgrp -R www-data bootstrap/cache
	sudo chmod -R ug+rwx bootstrap/cache
	sudo chown ${USER}:${USER} storage -R
	sudo chgrp -R www-data storage 
	sudo chmod -R ug+rwx storage

old-perm:
	sudo chown ${USER}:${USER} docker -R
	sudo chown ${USER}:${USER} storage -R
	sudo chown ${USER}:${USER} bootstrap/cache -R
	sudo chown ${USER}:${USER} node_modules -R
	sudo chown ${USER}:${USER} resources -R
	sudo chmod 777 resources -R
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache

test:
	docker-compose exec php-cli vendor/bin/phpunit

assets-install:
	docker exec app_node_1 yarn install

assets-rebuild:
	docker-compose exec npm rebuild node-sass --force

assets-dev:
	docker exec app_node_1 yarn run dev

assets-watch:
	docker exec app_node_1 yarn run watch

m-db:
	docker-compose exec php-cli php artisan migrate

memory: 
	sudo sysctl -w vm.max_map_count=262144