FROM php:8.4-fpm-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin

RUN set -eux; \
     install-php-extensions  intl #pdo pdo_mysql gd bz2

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=composer:2.10.3 /usr/bin/composer /usr/bin/composer

COPY ./app/composer.* ./

RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction

COPY ./app .

RUN composer dump-autoload --optimize
