FROM php:8.2-fpm

ENV DEBIAN_FRONTEND noninteractive

WORKDIR /var/www/app

RUN apt-get update --allow-releaseinfo-change \
    && apt-get install -y --no-install-recommends gnupg \
    g++ \
    procps \
    openssl \
    git \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libfreetype6-dev \
    libicu-dev  \
    libonig-dev \
    libxslt1-dev \
    acl \
    libpq-dev \
    libxml2-dev \
    && apt-get -y autoclean && apt-get -y autoremove && apt-get -y clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql pgsql zip xsl gd intl opcache exif calendar soap \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
