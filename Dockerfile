# Use the official PHP image with Apache
FROM php:8.0-apache

# Set working directory
WORKDIR /var/www/html

# Copy src/ into container web root
COPY ./src/ /var/www/html/

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache PHP module
RUN a2enmod php8.0

# Ensure Apache serves PHP files
RUN echo "<IfModule mime_module>\n\
    AddType application/x-httpd-php .php\n\
</IfModule>\n\
<IfModule dir_module>\n\
    DirectoryIndex index.php index.html\n\
</IfModule>" > /etc/apache2/conf-available/php.conf \
    && a2enconf php

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
