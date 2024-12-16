#!/bin/bash

if [ "$APP_ENV" != "local" ]; then

    # Elastic
    filebeat -e &

    # Caches
    php /var/www/html/artisan config:clear
    php /var/www/html/artisan config:cache
    php /var/www/html/artisan route:cache
fi

# PHP FPM
docker-php-entrypoint php-fpm
