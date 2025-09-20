# Use PHP CLI 8.2
FROM php:8.2-cli

# System packages + PHP extensions for Laravel + Postgres
RUN apt-get update && apt-get install -y \
    unzip git libzip-dev libpq-dev \
 && docker-php-ext-install pdo pdo_pgsql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# App dir
WORKDIR /app

# Copy app files
COPY . .

# Install PHP deps (no dev) & optimize
RUN composer install --no-dev --optimize-autoloader

# Expose via PHP's built-in server
# Render provides $PORT; bind 0.0.0.0 and serve /public
# Start up: run migrations & caches, then launch the PHP server
CMD sh -lc "php artisan migrate --force && php artisan storage:link || true && php artisan config:cache && php artisan route:cache && php artisan view:cache && php -S 0.0.0.0:${PORT} -t public"

