#!/bin/bash

# Exit on any error
set -e

echo "Starting setup for project..."

# ------------------------------
# 1. Install PHP dependencies
# ------------------------------
if composer install --no-dev --optimize-autoloader; then
    echo "Composer dependencies installed successfully."
else
    echo "ERROR: Composer install failed."
    exit 1
fi

# ------------------------------
# 2. Run Laravel migrations
# ------------------------------
if php artisan migrate --force; then
    echo "Migrations completed successfully."
else
    echo "ERROR: Migrations failed."
    exit 1
fi

# ------------------------------
# 3. Clear and cache Laravel
# ------------------------------
if php artisan view:clear \
   && php artisan route:clear \
   && php artisan cache:clear \
   && php artisan config:clear \
   && php artisan config:cache \
   && php artisan clear-compiled; then
    echo "Artisan clear and cache completed successfully."
else
    echo "ERROR: Artisan clear/cache failed."
    exit 1
fi

echo "Setup completed successfully!"
