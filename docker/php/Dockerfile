FROM phpswoole/swoole:4.6-php7.4

RUN apt-get update && apt-get install -y libzip-dev unzip libicu-dev

RUN pecl update-channels && \
    pecl install redis && \
    docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install intl opcache pcntl zip && \
    docker-php-ext-enable redis

COPY docker/php/opcache.ini $PHP_INI_DIR/conf.d/

WORKDIR /usr/src/app

COPY --chown=1000:1000 app /usr/src/app

RUN composer install -no --no-dev && \
    composer dump-env prod && \
    bin/console cache:warmup && \
    bin/console list

EXPOSE 9501

CMD ["bin/console", "swoole:server:run"]
