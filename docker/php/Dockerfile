FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libssl-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install sockets

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/NotificationService

COPY --chown=www-data:www-data ./app /var/www/NotificationService

RUN composer install

RUN chown -R www-data:www-data /var/www/NotificationService \
    && chmod -R 755 /var/www/NotificationService

EXPOSE 9000
CMD ["php-fpm"]
