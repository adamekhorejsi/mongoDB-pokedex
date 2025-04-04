FROM composer:lts as deps

WORKDIR /src

COPY composer.json /src/composer.json
RUN if [ -f composer.lock ]; then cp composer.lock /src/composer.lock; fi

RUN --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

FROM php:8.3-apache as final

# Enable the production PHP config
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Install system dependencies
RUN apt-get update && apt-get install -y \
       libssl-dev \
       unzip \
       curl \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Ensure .htaccess files are allowed
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Set up application directory
WORKDIR /var/www/html

# Copy application source code
COPY . /var/www/html

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

USER www-data
