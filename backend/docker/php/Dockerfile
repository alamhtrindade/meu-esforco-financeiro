#
# PHP Dependencies
#
FROM composer:2 AS vendor

COPY ./database/ database/

COPY ./composer.json ./composer.lock ./

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

# #
# # Application
# #
FROM php:8.2-fpm AS base-php

ENV TZ=America/Sao_Paulo \
    APP_HOME=/var/www/html

ARG BUILD_APP_ENV

WORKDIR $APP_HOME

# Configs for PHP FPM
COPY ./docker/php/production/opcache.ini "$PHP_INI_DIR/conf.d/opcache.ini"
COPY ./docker/php/production/php.ini "$PHP_INI_DIR/php.ini"
COPY ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

# Configs for Xdebug
COPY ./docker/php/local/xdebug.sh /tmp/
COPY ./docker/php/local/xdebug.ini /tmp/


RUN apt-get update && apt-get install -y --no-install-recommends \
    git  \
    curl  \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    unzip \
    supervisor \
    openssl \
    gnupg2 \
    wget \
    && docker-php-ext-install  \
    bcmath \
    mbstring \
    opcache \
    exif \
    pcntl \
    gd \
    zip \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && pecl install redis && docker-php-ext-enable redis \
    && mkdir /run/php \
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \
    # Install Xdebug
    && if [ "$BUILD_APP_ENV" = "local" ]; then chmod u+x /tmp/xdebug.sh && /tmp/xdebug.sh ; fi && rm -f /tmp/xdebug.sh \
    # Install Composer
    && if [ "$BUILD_APP_ENV" = "local" ]; then curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; fi 

WORKDIR $APP_HOME

COPY --chown=www-data:www-data . $APP_HOME/
COPY --chown=www-data:www-data --from=vendor /app/vendor/ $APP_HOME/vendor/

RUN chown -R www-data:root $APP_HOME \
    && chmod -R g=u $APP_HOME \
    && ln -sf /var/www/html/storage/app/public /var/www/html/public/storage

USER www-data

ENTRYPOINT [ "./docker/php/entrypoint.sh" ]
