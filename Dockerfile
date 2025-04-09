FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    supervisor

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory
COPY . /var/www/

# Install dependencies
RUN composer install --optimize-autoloader --no-dev

# Copy .env.example to .env if .env doesn't exist
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Set permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage

# Configure Nginx
COPY docker/nginx/nginx.conf /etc/nginx/sites-available/default
RUN ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

# Configure supervisord
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf



# Expose port 80
EXPOSE 80
RUN chmod -R 775 /var/www/bootstrap/cache

# Create entrypoint script
RUN echo '#!/bin/sh' > /entrypoint.sh && \
    echo 'php artisan key:generate --force' >> /entrypoint.sh && \
    echo 'php artisan config:cache' >> /entrypoint.sh && \
   # echo 'php artisan route:cache' >> /entrypoint.sh && \
    echo 'php artisan view:cache' >> /entrypoint.sh && \
    echo 'exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf' >> /entrypoint.sh && \
    chmod +x /entrypoint.sh

RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/app.ini
RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/app.ini
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/app.ini

# Start with entrypoint script
CMD ["/entrypoint.sh"]