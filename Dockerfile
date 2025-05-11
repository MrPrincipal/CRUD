# Dockerfile

FROM php:8.2-fpm

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html/Portifolio

COPY . .

RUN chown -R www-data:www-data /var/www/html/Portifolio
