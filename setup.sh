#!/bin/bash

# Exit on any error
set -e

# Run Laravel migrations inside the PHP container
if php artisan migrate; then
  echo "Migrations completed successfully."
else
  echo "ERROR: Migrations failed."
  exit 1
fi

# Run Laravel clear inside the PHP container
if php artisan view:clear && php artisan route:clear && php artisan cache:clear && php artisan config:clear && php artisan config:cache && php artisan clear-compile; then
  echo "Artisan clear completed successfully."
else
  echo "ERROR: Artisan clear failed."
  exit 1
fi

