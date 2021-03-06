FROM php:7.1-cli

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y zlib1g-dev

RUN docker-php-ext-install zip

RUN apt-get update -y && apt-get install -y sendmail libpng-dev

RUN docker-php-ext-install gd

WORKDIR /var/www