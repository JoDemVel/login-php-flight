FROM php:8.1-apache

COPY ./src /var/www/html/src
COPY index.php /var/www/html/index.php
COPY composer.json /var/www/html/composer.json
COPY .env /var/www/html/.env
COPY .htaccess /var/www/html/.htaccess

# Install dependencies
# a2enmod rewrite is for enabling mod_rewrite for apache server .htaccess file
RUN apt-get update && apt-get install -y libpq-dev zip unzip && docker-php-ext-install pdo pdo_pgsql && a2enmod rewrite

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN cd /var/www/html && composer install --no-interaction --no-progress --no-suggest

EXPOSE 80