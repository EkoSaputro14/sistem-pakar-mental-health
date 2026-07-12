#!/bin/bash
set -e

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    php artisan key:generate --force
fi

# Wait for MySQL
echo "Waiting for MySQL..."
until php artisan migrate:status --no-interaction > /dev/null 2>&1; do
    sleep 2
done
echo "MySQL ready!"

# Run migrations + seed
php artisan migrate --force --seed

# Cache config/routes for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache
exec apache2-foreground
