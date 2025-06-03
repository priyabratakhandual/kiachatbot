FROM php:7.4-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    zip unzip curl git libpng-dev libonig-dev libxml2-dev libzip-dev \
    libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip mbstring gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app code
COPY . .

# Copy .env file if not mounted externally
# COPY .env /var/www/.env

# Install PHP dependencies (fail build if vendor not created)
RUN composer install --no-dev --optimize-autoloader

# Generate app key if .env exists
RUN test -f .env && php artisan key:generate || echo ".env not found, skipping key generation"

# Set file permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Allow php-fpm to listen on external port
RUN sed -i 's|listen = .*|listen = 0.0.0.0:9000|' /usr/local/etc/php-fpm.d/www.conf

EXPOSE 9000

CMD ["php-fpm"]
