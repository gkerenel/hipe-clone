FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    sqlite3 \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && \
    apt-get install -y nodejs

RUN mkdir /var/www/hipe
COPY . /var/www/hipe

WORKDIR /var/www/hipe

RUN composer update
RUN composer install

RUN npm update
RUN npm install

RUN chown -R www-data:www-data /var/www/hipe/storage /var/www/hipe/bootstrap/cache

RUN cp .env.demo .env

RUN php artisan key:generate

RUN php artisan migrate

EXPOSE 8000

RUN npm install -g concurrently

CMD ["sh", "-c", "concurrently \"php artisan serve --host=0.0.0.0 --port=8000\" \"npm run dev\""]
