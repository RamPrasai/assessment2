# Laravel + PHP 8.2 + SQLite (Render)
FROM php:8.2-cli

# System deps + PHP extensions
RUN apt-get update && apt-get install -y \
    unzip git libzip-dev sqlite3 libsqlite3-dev libonig-dev \
 && docker-php-ext-install pdo pdo_sqlite mbstring zip \
 && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# App
WORKDIR /app
COPY . .

# PHP deps (prod) + make sqlite db + permissions
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader \
 && mkdir -p database && touch database/database.sqlite \
 && mkdir -p storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache || true

EXPOSE 8000

# Boot sequence
CMD sh -lc '\
  php artisan config:clear && php artisan route:clear && php artisan view:clear && \
  php artisan migrate --force && php artisan db:seed --force || true && \
  php artisan storage:link || true && \
  php artisan config:cache && php artisan route:cache && php artisan view:cache && \
  php artisan serve --host=0.0.0.0 --port=${PORT} \
'
