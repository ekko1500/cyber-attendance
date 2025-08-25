# Use official PHP-Apache image
FROM php:8.0-apache

# Install PHP extensions you need
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy app source to Apache root
COPY ./src/ /var/www/html/

# Ensure Apache looks for index.php first
RUN echo "<IfModule dir_module>\n    DirectoryIndex index.php index.html\n</IfModule>" > /etc/apache2/conf-enabled/docker-php.conf

# Fix permissions for Apache
RUN chown -R www-data:www-data /var/www/html

# Expose HTTP port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
