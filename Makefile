docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build: perm
	docker-compose up --build -d

v-php:
	docker exec app_php-cli_1 php -v

perm:
	sudo chown ${USER}:${USER} docker -R
	