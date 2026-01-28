FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    acl \
    bash \
    git \
    zip \
    unzip \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install \
    intl \
    opcache \
    zip \
    mbstring

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Expose port 9000
EXPOSE 9000

CMD ["php-fpm"]
