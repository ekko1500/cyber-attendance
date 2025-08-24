# Use the official PHP image with Apache
FROM php:8.0-apache

# Set the working directory
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Install any needed packages
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql

# Ensure Apache serves index.php by default
RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
