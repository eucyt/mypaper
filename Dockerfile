# For github action
FROM php:8.2-fpm-buster as builder

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

COPY ./laravel /laravel
WORKDIR /laravel

RUN apt-get update && \
  apt-get -y install git unzip libzip-dev libicu-dev libonig-dev && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  docker-php-ext-install intl pdo_mysql zip bcmath

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev && composer global require "laravel/installer"

RUN if [ ! -d "database/seeds" ]; then mkdir database/seeds; fi
RUN if [ ! -d "database/factories" ]; then mkdir database/factories; fi

RUN php artisan cache:clear \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

RUN chown -R www-data:www-data storage


FROM php:8.2-apache

COPY ./docker/apache/000-default.conf /etc/apache2/sites-available/
COPY --from=builder /laravel /var/www/laravel

RUN a2ensite 000-default
