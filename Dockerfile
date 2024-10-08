# Use the official PHP image with the version you need
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /app

# Copy application files
COPY . .

# Install Composer dependencies
RUN composer install --ignore-platform-reqs

# Create necessary directories for Laravel
RUN mkdir -p /var/log/nginx && mkdir -p /var/cache/nginx

# Expose the necessary port
EXPOSE 80

# Command to run your application
CMD ["php-fpm"]
