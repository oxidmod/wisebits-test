up:
	@ \
 	docker-compose up -d && \
    docker-compose exec php composer install -no --no-dev && \
	docker-compose exec php composer dump-env prod && \
    docker-compose exec php bin/console cache:warmup &&\
	echo Service started at http://localhost:5555/

down:
	@ \
	docker-compose down


