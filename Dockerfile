# --- Build Stage ---
FROM php:8.2-fpm-alpine AS build

# Install sistem dependencies dan PHP extensions yang dibutuhkan untuk build
RUN apk add --no-cache \
    git \
    zip \
    unzip \
    nodejs \
    npm \
    # PHP extensions (sesuaikan dengan kebutuhanmu dan versi PHP)
    php82-pdo_mysql \
    php82-dom \
    php82-xml \
    php82-mbstring \
    php82-tokenizer \
    php82-bcmath \
    php82-ctype \
    php82-fileinfo \
    php82-openssl \
    php82-pdo \
    php82-gd \
    php82-session \
    php82-curl \
    && rm -rf /var/cache/apk/*

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

COPY package.json package-lock.json ./
RUN npm install && npm run build

COPY . .

# --- Production Stage ---
FROM php:8.2-fpm-alpine AS production

# Install hanya sistem dependencies dan PHP extensions yang dibutuhkan untuk RUNTIME
RUN apk add --no-cache \
    mysql-client \
    # PHP extensions yang benar-benar dibutuhkan saat runtime
    php82-pdo_mysql \
    php82-dom \
    php82-xml \
    php82-mbstring \
    php82-tokenizer \
    php82-bcmath \
    php82-ctype \
    php82-fileinfo \
    php82-openssl \
    php82-pdo \
    php82-gd \
    php82-session \
    php82-curl \
    && rm -rf /var/cache/apk/*

WORKDIR /app

COPY --from=build /app/vendor /app/vendor
COPY --from=build /app/node_modules /app/node_modules
COPY --from=build /app/public/build /app/public/build
COPY --from=build /app/.env.example /app/.env.example
COPY --from=build /app /app

# Atur izin direktori storage dan bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000 # Pastikan port ini sesuai dengan Port di Railway Settings (8080)

CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"] # Pastikan port ini sesuai dengan Port di Railway Settings (8080)