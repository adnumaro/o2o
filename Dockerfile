FROM php:7.4.2-fpm-alpine

# Install Symfony requirements
RUN apk --update upgrade \
	&& apk add --no-cache autoconf automake make gcc g++ $PHPIZE_DEPS libzip-dev zlib-dev icu-dev nano \
	&& pecl install apcu-5.1.18 \
    && pecl install xdebug-2.9.1 \
    && pecl clear-cache \
	&& docker-php-ext-configure zip \
	&& docker-php-ext-install -j$(nproc) \
		intl \
		zip \
		bcmath \
		opcache \
	&& docker-php-ext-enable \
		apcu \
		opcache \
		xdebug \
    && echo "error_reporting=E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "display_startup_errors=On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "display_errors=On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini;

# Install Composer globally
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY etc/php/ /usr/local/etc/php/

WORKDIR /app

COPY composer.json composer.lock ./

# prevent the reinstallation of vendors at every changes in the source code
RUN composer install --no-scripts --no-autoloader
RUN composer clear-cache

COPY . ./
