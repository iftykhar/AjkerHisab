# 1. Use PHP with Apache
FROM php:8.2-apache

# 2. Enable pretty URL rewrite
RUN a2enmod rewrite

# 3. Set working dir
WORKDIR /var/www/html

# 4. Copy entire project
COPY . /var/www/html/

# 5. Clear default webroot and set public folder as root
RUN rm -rf /var/www/html/*
# Adjust folder name below if not 'Public/'
COPY Public/ /var/www/html/

# 6. Make Storage writable
RUN chmod -R 777 /var/www/html/Storage

EXPOSE 80
