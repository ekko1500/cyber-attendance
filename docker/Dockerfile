# Use the official PHP image with Apache
FROM php:8.0-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY ./src /var/www/html

# Ensure Apache serves index.php by default
RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
