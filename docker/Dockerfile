FROM php:7.3-fpm

ARG xdebug

## System Environment
ENV TZ UTC
ENV DEBIAN_FRONTEND noninteractive
ENV ENVIRONMENT dev

RUN apt-get update && apt-get install -y \
        wget \
        unzip \
        nano

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# Install PECL Dependencies
RUN docker-php-ext-install pdo pdo_mysql

# Build Application
WORKDIR /app
RUN chown www-data:www-data /app
COPY --chown=www-data:www-data / /app

USER www-data

RUN composer install