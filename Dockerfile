# Use official PHP + Apache image
FROM php:8.2-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all project files into the container
COPY . .

# Set Apache to serve from /var/www/html/Public
ENV APACHE_DOCUMENT_ROOT /var/www/html/Public

# Update Apache config to use new DocumentRoot
RUN sed -ri -e 's!/var/www/html!/var/www/html/Public!g' /etc/apache2/sites-available/000-default.conf

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Make storage folder writable
RUN chmod -R 777 /var/www/html/Storage || echo "No Storage dir found"

EXPOSE 80
