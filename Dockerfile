FROM php:8.2-apache

# Active mod_rewrite
RUN a2enmod rewrite

# Installe les extensions nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Installe Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Configure Apache pour pointer vers /var/www/html
WORKDIR /var/www/html

# Droits
RUN chown -R www-data:www-data /var/www/html
