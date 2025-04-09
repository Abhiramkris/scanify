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

# Set permissions - UPDATED for proper write access
RUN chown -R www-data:www-data /var/www
RUN chmod -R 777 /var/www/storage
RUN chmod -R 777 /var/www/bootstrap/cache

# Configure Nginx
COPY docker/nginx/nginx.conf /etc/nginx/sites-available/default
RUN ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

# Configure supervisord
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf  

# Expose port 80
EXPOSE 80

# Create entrypoint script - UPDATED to run migrations
RUN echo '#!/bin/sh' > /entrypoint.sh && \
    echo 'php artisan key:generate --force' >> /entrypoint.sh && \
    echo 'php artisan migrate --force' >> /entrypoint.sh && \
    echo 'php artisan config:cache' >> /entrypoint.sh && \
    echo 'php artisan view:cache' >> /entrypoint.sh && \
    echo 'exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf' >> /entrypoint.sh && \
    chmod +x /entrypoint.sh

# Add PHP error display for debugging
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/app.ini
RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/app.ini
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/app.ini

# Start with entrypoint script
CMD ["/entrypoint.sh"]