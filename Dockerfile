# Use the official PHP image with Apache
FROM php:8.0-apache

# Set working directory
WORKDIR /var/www/html

# Copy src/ into container web root
COPY ./src/ /var/www/html/

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ensure Apache serves PHP files
RUN echo "<IfModule dir_module>\n    DirectoryIndex index.php index.html\n</IfModule>" > /etc/apache2/conf-available/docker-php.conf \
    && a2enconf docker-php

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
