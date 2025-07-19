#!/bin/bash

# Setup Laravel environment for MySQL
echo "Setting up Laravel environment for MySQL..."

# Wait for database to be ready
echo "Waiting for database connection..."
sleep 10

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Update .env for MySQL
sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env
sed -i 's/# DB_HOST=127.0.0.1/DB_HOST=db/' .env
sed -i 's/# DB_PORT=3306/DB_PORT=3306/' .env
sed -i 's/# DB_DATABASE=laravel/DB_DATABASE=project_management/' .env
sed -i 's/# DB_USERNAME=root/DB_USERNAME=laravel/' .env
sed -i 's/# DB_PASSWORD=/DB_PASSWORD=laravel123/' .env

# Remove SQLite database file if exists
rm -f database/database.sqlite

echo "Environment setup completed!"
echo "Database connection: MySQL"
echo "Database host: db"
echo "Database name: project_management"