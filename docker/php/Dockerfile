FROM php:7.4-fpm

RUN apt-get update && \
apt-get install -y \
libzip-dev unzip

RUN docker-php-ext-install zip
RUN pecl install apcu && docker-php-ext-enable apcu
RUN pecl install redis && docker-php-ext-enable redis

RUN php -m

RUN curl https://getcomposer.org/download/2.0.2/composer.phar --output /usr/bin/composer && chmod a+x /usr/bin/composer

WORKDIR /usr/src/app

COPY --chown=1000:1000 app /usr/src/app

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin
