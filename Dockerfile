# Laravel + PHP 8.2 + Postgres (Render)
FROM php:8.2-cli

# System deps + PHP extensions
RUN apt-get update && apt-get install -y \
    unzip git libzip-dev libpq-dev \
 && docker-php-ext-install pdo mbstring pdo_pgsql zip \
 && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# App dir
WORKDIR /app
COPY . .

# PHP deps (prod) + permissions
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader \
 && mkdir -p storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache || true

# (Optional) document port for local clarity (Render sets $PORT)
EXPOSE 8000

# Boot sequence:
# 1) clear stale caches (so ENV from Render is read)
# 2) wait for DB & migrate
# 3) seed (safe to rerun), storage link
# 4) cache config/routes/views
# 5) start Laravel server on $PORT
CMD sh -lc '\
  php artisan config:clear && php artisan route:clear && php artisan view:clear && \
  until php artisan migrate --force; do echo "⏳ Waiting for DB..."; sleep 3; done && \
  php artisan db:seed --force || true && \
  php artisan storage:link || true && \
  php artisan config:cache && php artisan route:cache && php artisan view:cache && \
  php artisan serve --host=0.0.0.0 --port=${PORT} \
'
