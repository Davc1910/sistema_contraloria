FROM php:8.2-cli

# Instala dependencias del sistema incluyendo PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

# Instala Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Configura el directorio de trabajo
WORKDIR /var/www/html

# Copia el código de la aplicación
COPY . .

# ELIMINA CUALQUIER CACHE EXISTENTE PRIMERO
RUN rm -f bootstrap/cache/config.php

# Instala dependencias de PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Configura permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Crear enlace simbólico de storage
RUN php artisan storage:link || ln -sfn /var/www/html/storage/app/public /var/www/html/public/storage

# LIMPIAR CACHE COMPLETAMENTE antes de cualquier operación
RUN php artisan optimize:clear

# Cache de vistas si es necesario
RUN php artisan view:cache

# Expone el puerto 8000
EXPOSE 8000

# Comando de inicio para PostgreSQL
CMD sh -c "php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=8000"
