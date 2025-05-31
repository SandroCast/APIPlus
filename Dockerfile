FROM php:8.2-fpm

# Instala pacotes necessários
RUN apt-get update && apt-get install -y nginx git unzip curl

# Instala extensões do PHP
RUN docker-php-ext-install pdo pdo_mysql

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos da aplicação
COPY . .

# Comando padrão
CMD ["php-fpm"]
