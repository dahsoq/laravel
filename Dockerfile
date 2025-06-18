FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libpng-dev libonig-dev libxml2-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip bcmath gd exif pcntl sockets

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Выполняем твой install:api
RUN php artisan install:api

RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
