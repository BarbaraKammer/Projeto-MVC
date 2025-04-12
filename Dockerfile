FROM php:8.1-apache

# Instalar extensões necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar os arquivos do projeto para o container
COPY . /var/www/html/

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Rodar o composer install
RUN composer install

# Ativar reescrita no Apache (caso precise para URLs amigáveis)
RUN a2enmod rewrite
