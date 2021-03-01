FROM php:8.0-fpm

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apt-get install autoconf

RUN pecl install xdebug && docker-php-ext-enable xdebug

WORKDIR /usr/src/app
