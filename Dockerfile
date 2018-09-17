FROM php:7.1-cli

RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www