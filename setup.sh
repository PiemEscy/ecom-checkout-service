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

