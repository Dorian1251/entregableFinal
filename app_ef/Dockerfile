FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY app_ef/ /var/www/html/

RUN chmod -R 755 /var/www/html/tmp /var/www/html/logs

WORKDIR /var/www/html

EXPOSE 80