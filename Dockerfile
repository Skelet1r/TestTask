FROM php:8.4

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html

COPY . .

RUN mkdir -p /var/www/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/storage /var/www/html/bootstrap/cache

RUN composer --version

RUN composer install --no-interaction --no-dev --prefer-dist
RUN composer require spatie/laravel-permission

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]






