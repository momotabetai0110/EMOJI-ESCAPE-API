#!/bin/bash

# Create src directory if it doesn't exist
mkdir -p src

# Install Laravel 11 using Composer
docker run --rm -v $(pwd)/src:/app composer create-project laravel/laravel .

# Set proper permissions
docker run --rm -v $(pwd)/src:/app -w /app alpine chmod -R 777 storage bootstrap/cache

# Copy .env.example to .env
cp src/.env.example src/.env

# Update .env file with Docker database configuration
sed -i 's/DB_HOST=127.0.0.1/DB_HOST=db/g' src/.env
sed -i 's/DB_DATABASE=laravel/DB_DATABASE=laravel/g' src/.env
sed -i 's/DB_USERNAME=root/DB_USERNAME=laravel/g' src/.env
sed -i 's/DB_PASSWORD=/DB_PASSWORD=secret/g' src/.env

# Update Redis configuration
sed -i 's/REDIS_HOST=127.0.0.1/REDIS_HOST=redis/g' src/.env

echo "Laravel 11 installation completed!"
echo "You can now run: docker-compose up -d"