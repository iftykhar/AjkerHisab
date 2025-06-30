# Use PHP with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory inside container
WORKDIR /var/www/html

# Copy all files from your repo to the container's /var/www/html
COPY . /var/www/html

# Ensure Apache uses the public folder as the web root
RUN rm -rf /var/www/html/*
COPY Public/ /var/www/html/

# Optional: expose port (Render already knows to use port 80)
EXPOSE 80
