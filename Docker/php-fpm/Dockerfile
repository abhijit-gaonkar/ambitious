FROM php:fpm
RUN docker-php-ext-install -j$(nproc) pdo pdo_mysql

# Copy PHP files
COPY . /var/www/html/

# Expose and start PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]