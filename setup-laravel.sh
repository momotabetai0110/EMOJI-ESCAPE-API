#!/bin/bash

# Create src directory if it doesn't exist
mkdir -p src

# Create Laravel 12 project
docker run --rm -v $(pwd)/src:/app composer create-project laravel/laravel:^12.0 .

# Set proper permissions
docker run --rm -v $(pwd)/src:/app -w /app alpine chmod -R 777 storage bootstrap/cache

# Copy .env.example to .env
cp src/.env.example src/.env

# Update .env file for Docker environment
sed -i 's/DB_HOST=127.0.0.1/DB_HOST=db/g' src/.env
sed -i 's/DB_DATABASE=laravel/DB_DATABASE=laravel/g' src/.env
sed -i 's/DB_USERNAME=root/DB_USERNAME=laravel/g' src/.env
sed -i 's/DB_PASSWORD=/DB_PASSWORD=password/g' src/.env

echo "Laravel 12 project created successfully!"
echo "You can now run: docker-compose up -d"