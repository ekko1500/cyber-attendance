# Use the official PHP image with Apache
FROM php:8.0-apache

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY ./src/ /var/www/html/

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache modules needed for PHP
RUN a2enmod rewrite

# Ensure Apache serves PHP files by default
RUN echo "<IfModule dir_module>\n    DirectoryIndex index.php index.html\n</IfModule>" > /etc/apache2/conf-available/docker-php.conf \
    && a2enconf docker-php

# Permissions
RUN chown -R www-data:www-data /var/www/html

# Expose Apache port
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
