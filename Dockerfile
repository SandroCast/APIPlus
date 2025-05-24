FROM php:8.2-fpm
RUN apt-get update && apt-get install -y nginx git unzip curl
WORKDIR /var/www/html
COPY . .
RUN docker-php-ext-install pdo pdo_mysql
CMD ["php-fpm"]