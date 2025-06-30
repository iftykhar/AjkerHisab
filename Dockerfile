# Use official PHP + Apache base image
FROM php:8.2-apache

# Enable mod_rewrite for Laravel-style routing
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all files into container
COPY . .

# Install required PHP extensions (adjust as needed)
RUN docker-php-ext-install pdo pdo_mysql

# Make Storage writable
RUN chmod -R 777 /var/www/html/Storage || echo "No Storage dir found"

EXPOSE 80
