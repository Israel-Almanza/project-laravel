#!/bin/sh
set -e
cd /var/www

PORT="${PORT:-10000}"
export PORT
envsubst '$PORT' < /var/www/docker/nginx.conf.template > /etc/nginx/sites-available/default

php artisan config:cache
php artisan route:cache
php artisan view:cache

nginx
exec php-fpm
