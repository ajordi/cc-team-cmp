# Use oficial PHP with fpm.
FROM php:7.2.5-fpm

# Install extension dependencies
RUN apt-get update && apt-get -y install \
    git \
    zlib1g-dev \
    zip \
    mysql-client

# Install PHP extensions
RUN docker-php-ext-install \
    zip \
    mysqli \
    pdo_mysql \
    bcmath \
    && pecl install xdebug

# Install composer and NodeJS
RUN    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer \
    && composer global require "hirak/prestissimo" \
    && apt-get clean

# Copy system configuration
COPY ./docker/php/rootfs/ /

# Copy source code and the docker environment
COPY ./src/ /opt/app

# Set working directory
WORKDIR /opt/app/

