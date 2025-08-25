FROM php:8.0-apache

WORKDIR /var/www/html

COPY ./src/ /var/www/html/

RUN docker-php-ext-install mysqli pdo pdo_mysql

EXPOSE 80

CMD ["apache2-foreground"]
