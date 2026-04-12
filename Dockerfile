# Imagen base PHP
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    nodejs \
    npm \
    nginx

# Instalar extensiones PHP necesarias para Laravel
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Instalar dependencias frontend y compilar assets
RUN npm install && npm run build

# Permisos (muy importante)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copiar configuración de nginx
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Exponer puerto
EXPOSE 10000

# Comando de arranque
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    nginx && \
    php-fpm