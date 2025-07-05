@echo off
echo Creating Laravel 12 project...

REM Create src directory if it doesn't exist
if not exist "src" mkdir src

REM Create Laravel 12 project
docker run --rm -v %cd%/src:/app composer create-project laravel/laravel:^12.0 .

REM Set proper permissions
docker run --rm -v %cd%/src:/app -w /app alpine chmod -R 777 storage bootstrap/cache

REM Copy .env.example to .env
copy src\.env.example src\.env

echo Laravel 12 project created successfully!
echo You can now run: docker-compose up -d
pause