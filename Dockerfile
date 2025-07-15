# --- Build Stage ---
# Gunakan PHP 8.2 FPM Alpine sebagai base image untuk proses build.
# Alpine adalah distribusi Linux yang ringan, cocok untuk container.
FROM php:8.2-fpm-alpine AS build

# Install sistem dependencies dan PHP extensions yang dibutuhkan
# untuk proses build aplikasi Laravel (termasuk Composer dan NPM).
RUN apk add --no-cache \
    # Sistem tools dasar yang dibutuhkan
    git \
    zip \
    unzip \
    curl \
    nodejs \
    npm \
    # Ekstensi PHP yang esensial untuk Laravel dan Composer.
    # Pastikan daftar ini mencakup semua yang dibutuhkan oleh paket-paketmu.
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
    php82-json \
    php82-opcache \
    # Bersihkan cache APK setelah instalasi untuk mengurangi ukuran image.
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man /usr/lib/php*/pear


RUN echo "extension=pdo_mysql.so" 

# Unduh dan instal Composer secara global di dalam container.
# Ini penting agar perintah 'composer' bisa ditemukan.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory untuk aplikasi di dalam container.
WORKDIR /app

# Salin semua file aplikasi dari direktori lokal ke dalam container.
# Ini dilakukan di awal build stage agar 'artisan package:discover'
# bisa mengakses semua file proyek yang dibutuhkan.
COPY . .

# Salin file composer.json dan composer.lock.
# Ini akan menimpa file yang sudah disalin oleh 'COPY . .' jika ada,
# dan memastikan Composer menggunakan versi dependensi yang spesifik.
COPY composer.json composer.lock ./


RUN composer install --no-dev --optimize-autoloader --verbose || exit 1; echo "Composer install failed. Check logs above for details."

# Salin file package.json dan package-lock.json untuk caching Node.js.
COPY package.json package-lock.json ./

# Jalankan npm install untuk menginstal dependensi Node.js,
# lalu npm run build untuk meng-compile aset Vite/Tailwind.
RUN npm install && npm run build

# --- Production Stage ---
# Gunakan base image PHP FPM Alpine yang sama untuk stage produksi.
# Image produksi akan lebih kecil karena hanya menyertakan runtime dependencies.
FROM php:8.2-fpm-alpine AS production

# Install hanya sistem dependencies dan PHP extensions yang dibutuhkan untuk RUNTIME.
# Ini adalah daftar minimal yang diperlukan agar aplikasi berjalan.
RUN apk add --no-cache \
    mysql-client \
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
    php82-json \
    php82-opcache \
    && rm -rf /var/cache/apk/*

WORKDIR /app


COPY --from=build /app/vendor /app/vendor
COPY --from=build /app/node_modules /app/node_modules
COPY --from=build /app/public/build /app/public/build
COPY --from=build /app/.env.example /app/.env.example

COPY --from=build /app /app


RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache


EXPOSE 8080


CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8080"]