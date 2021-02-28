FROM php:fpm-alpine3.12

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

WORKDIR /usr/src/app
