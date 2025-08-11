#!/bin/bash
# Raja Medical Deployment Script

echo "🏥 Raja Medical - Starting Deployment..."

# Install dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
echo "🎨 Building frontend assets..."
npm install
npm run build

# Clear and cache Laravel configurations
echo "⚙️ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Seed the database (only on first deployment)
echo "🌱 Seeding database..."
php artisan db:seed --force

echo "✅ Deployment completed successfully!"
echo "🌐 Your Raja Medical website is now live!"