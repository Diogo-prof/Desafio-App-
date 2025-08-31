FROM php:8.2-apache

RUN apt-get update && apt-get install -y unzip git \
    && docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar composer.json primeiro e instalar dependências
COPY composer.json composer.lock* ./
RUN composer install --no-scripts --no-interaction --prefer-dist

# Copiar o resto do código
COPY . .

# Gerar autoload
RUN composer dump-autoload --optimize

# Ajustar DocumentRoot
RUN sed -i 's#/var/www/html#/var/www/html/public#' /etc/apache2/sites-available/000-default.conf

# Permissões
RUN chown -R www-data:www-data /var/www/html
