FROM php:8.0.5-fpm-alpine

WORKDIR /var/www

RUN  apk update && apk add \
     build-base \
     nano  

RUN  docker-php-ext-install   pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

## Install YAML
RUN apk add --no-cache --virtual .build-deps \
    g++ make autoconf yaml-dev

RUN pecl channel-update pecl.php.net
RUN pecl install yaml && docker-php-ext-enable yaml

RUN apk add --no-cache yaml

RUN apk del --purge .build-deps
####

RUN  addgroup  -g  1000 -S  www  && \
     adduser  -u  1000 -S www  -G www

USER  www

COPY  --chown=www:www  ./www /var/www


EXPOSE 9000