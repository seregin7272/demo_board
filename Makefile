docker-up: memory perm
	docker-compose up -d

docker-down:
	docker-compose down

docker-build: memory
	docker-compose up --build -d

v-php:
	docker-compose php-cl php -v

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
	docker-compose exec node yarn install

assets-rebuild:
	docker-compose exec npm rebuild node-sass --force

assets-dev:
	docker-compose exec node yarn run dev

assets-watch:
	docker-compose node yarn run watch

m-db:
	docker-compose exec php-cli php artisan migrate

memory: 
	sudo sysctl -w vm.max_map_count=262144