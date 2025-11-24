#!/bin/bash

# Exit on any error
set -e

# Validate required environment variables
: "${DB_HOST:?DB_HOST not set}"
: "${DB_DATABASE:?DB_DATABASE not set}"
: "${DB_USERNAME:?DB_USERNAME not set}"
: "${DB_PASSWORD:?DB_PASSWORD not set}"

echo "Starting setup for $DB_DATABASE..."
echo "Host: $DB_HOST..."
echo "Username: $DB_USERNAME..."
echo "Password: $DB_PASSWORD..."

# Wait for DB to be ready (ping the DB container directly)
echo "Waiting for database..."
MAX_RETRIES=20
COUNT=0
until docker exec db mysql -u "$DB_USERNAME" -p"$DB_PASSWORD" -e "SELECT 1;" &> /dev/null; do
  COUNT=$((COUNT+1))
  if [ $COUNT -ge $MAX_RETRIES ]; then
    echo "ERROR: Could not connect to database after $MAX_RETRIES attempts."
    exit 1
  fi
  echo "Waiting for DB..."
  sleep 2
done

echo "Database is reachable."

# Create database if it doesn't exist (inside the DB container)
if docker exec db mysql -u "$DB_USERNAME" -p"$DB_PASSWORD" -e "USE $DB_DATABASE;" &> /dev/null; then
  echo "Database $DB_DATABASE already exists."
else
  echo "Creating database $DB_DATABASE..."
  docker exec db mysql -u "$DB_USERNAME" -p"$DB_PASSWORD" -e "CREATE DATABASE $DB_DATABASE;"
fi

# Run Laravel migrations inside the PHP container
if php artisan migrate; then
  echo "Migrations completed successfully."
else
  echo "ERROR: Migrations failed."
  exit 1
fi

echo "Setup completed for $DB_DATABASE."
