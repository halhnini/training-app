FROM php:7.4-apache

RUN docker-php-ext-install mysqli pdo_mysql && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y && apt-get install -y git zip
RUN a2enmod rewrite && service apache2 restart

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 8085
