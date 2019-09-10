FROM composer:1.8.5 as composer

COPY composer.json composer.lock /app/
RUN set -xe \
    && composer install --no-dev --no-scripts --no-suggest --no-interaction --prefer-dist --optimize-autoloader
COPY . /app
RUN composer dump-autoload --no-dev --optimize --classmap-authoritative

FROM php:7-fpm as php

WORKDIR /var/www/html
RUN apt-get update \
    && apt-get install -y \
    acl procps netcat-openbsd
COPY . /var/www/html

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY --from=composer /app/vendor /var/www/html/vendor

RUN chmod -R 777 /var/www/html/var/cache
RUN chmod -R 777 /var/www/html/var/log