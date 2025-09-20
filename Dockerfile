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

# Fix permissions for cache/storage (build-time)
RUN chmod -R 775 storage bootstrap/cache || true

# 🚀 Start: clear config, wait for DB, migrate, cache, then serve public/
CMD sh -lc 'php artisan config:clear; \
  until php artisan migrate --force; do echo "Waiting for DB..."; sleep 3; done; \
  php artisan storage:link || true; \
  php artisan config:cache; php artisan route:cache; php artisan view:cache; \
  php -S 0.0.0.0:${PORT} -t public'
