# Use the official PHP image with Apache
FROM php:8.1-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all files into the container
COPY . .

# Move all public files to web root
RUN rm -rf /var/www/html/index.html && \
    cp -r Public/* /var/www/html/ && \
    rm -rf Public

# Make Storage folder writable
RUN chmod -R 777 /var/www/html/Storage

# Expose port 80 (used by Apache)
EXPOSE 80
