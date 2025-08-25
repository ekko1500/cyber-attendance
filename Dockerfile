FROM php:8.0-apache

WORKDIR /var/www/html

COPY ./src/ /var/www/html/

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache PHP module explicitly
RUN a2enmod php8.0

RUN echo "<IfModule dir_module>\n    DirectoryIndex index.php index.html\n</IfModule>" > /etc/apache2/conf-available/docker-php.conf \
    && a2enconf docker-php

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
