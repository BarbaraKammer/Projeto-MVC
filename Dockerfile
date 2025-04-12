FROM php:8.2-apache

# 1. Instalação de dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# 2. Configuração do Apache
RUN a2enmod rewrite && \
    sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 3. Instalação do Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Configuração do ambiente
WORKDIR /var/www/html
COPY . .

# 5. Ajuste de permissões genérico (sem referência à pasta storage)
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \;
