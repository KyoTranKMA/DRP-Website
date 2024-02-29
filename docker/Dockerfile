FROM php:8.2-apache 
RUN pecl install redis && docker-php-ext-enable redis 
RUN docker-php-ext-install pdo pdo_mysql  
EXPOSE 80 
