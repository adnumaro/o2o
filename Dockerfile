FROM php:7.4.2-fpm-alpine

WORKDIR /o2o

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ icu-dev \
    && pecl install xdebug-2.9.1 \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        opcache \
        intl \
    && docker-php-ext-enable \
        opcache

COPY etc/php/ /usr/local/etc/php/
