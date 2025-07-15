# --- Build Stage ---
FROM php:8.2-fpm-alpine AS build

# Install sistem dependencies dan PHP extensions yang dibutuhkan untuk build
RUN apk add --no-cache \
    git \
    zip \
    unzip \
    nodejs \
    npm \
    # PHP extensions (sesuaikan dengan kebutuhan spesifik Laravel-mu)
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

# Unduh dan instal Composer secara global
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Salin composer.json dan composer.lock terlebih dahulu untuk caching Docker
COPY composer.json composer.lock ./

# Jalankan composer install (akan menemukan Composer yang baru saja diinstal)
RUN composer install --no-dev --optimize-autoloader

# Salin package.json dan package-lock.json untuk caching Node.js
COPY package.json package-lock.json ./

# Jalankan npm install dan npm run build untuk aset Vite/Tailwind
RUN npm install && npm run build

# Salin sisa file aplikasi dari direktori lokal ke dalam image
COPY . .

# --- Production Stage ---
# Gunakan base image PHP FPM Alpine yang sama untuk stage produksi
FROM php:8.2-fpm-alpine AS production

# Install hanya sistem dependencies dan PHP extensions yang dibutuhkan untuk RUNTIME
RUN apk add --no-cache \
    mysql-client \
    # PHP extensions yang benar-benar dibutuhkan saat aplikasi berjalan
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

# Salin file-file yang sudah di-build dari stage 'build'
# Ini termasuk vendor (dependensi PHP), node_modules (dependensi JS), dan aset Vite
COPY --from=build /app/vendor /app/vendor
COPY --from=build /app/node_modules /app/node_modules
COPY --from=build /app/public/build /app/public/build
COPY --from=build /app/.env.example /app/.env.example # Salin contoh .env

# Salin sisa file aplikasi dari stage build (kode sumbermu)
COPY --from=build /app /app

# Atur izin direktori storage dan bootstrap/cache agar bisa ditulis oleh web server
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Ekspos port tempat aplikasi akan berjalan (sesuai Railway Settings: 8080)
EXPOSE 8080

# Perintah untuk menjalankan aplikasi Laravel saat kontainer dimulai
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8080"]