# Imagen base PHP (FPM + extensiones para Laravel)
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y --no-install-recommends \
    gettext-base \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    nodejs \
    npm \
    nginx \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP necesarias para Laravel
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copiar archivos del proyecto
COPY . .

# Normalizar fin de línea del entrypoint (útil si se edita en Windows) y permisos
RUN sed -i 's/\r$//' /var/www/docker/entrypoint.sh \
    && chmod +x /var/www/docker/entrypoint.sh

# Instalar dependencias PHP (Render / CI: sin prompts)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Instalar dependencias frontend y compilar assets
RUN npm ci && npm run build

# Permisos (storage y bootstrap/cache deben ser escribibles por www-data)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Render inyecta PORT; nginx usa la plantilla generada en el entrypoint
EXPOSE 10000

ENTRYPOINT ["/var/www/docker/entrypoint.sh"]
