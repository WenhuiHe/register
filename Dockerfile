FROM php:5.6.39-fpm

COPY ./sources.list /etc/apt/sources.list.tmp
RUN mv /etc/apt/sources.list.tmp /etc/apt/sources.list;
RUN apt update


RUN apt install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install $mc gd \
    && :\
    && apt install -y libicu-dev \
    && docker-php-ext-install $mc intl \
    && :\
    && apt install -y libbz2-dev \
    && docker-php-ext-install $mc bz2 \
    && :\
    && docker-php-ext-install $mc zip \
    && docker-php-ext-install $mc pcntl \
    && docker-php-ext-install $mc pdo_mysql \
    && docker-php-ext-install $mc mysqli \
    && docker-php-ext-install $mc mbstring \
    && docker-php-ext-install $mc exif